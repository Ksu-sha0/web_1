function showMsg(msg, status="ok"){
    let alertsContainer = document.querySelector('.alerts');
    let newAlert = document.querySelector('.alert').cloneNode(true);
    newAlert.querySelector('.msg').innerHTML = msg;
    newAlert.classList.remove('d-none');
    if(status != "ok"){
        newAlert.classList.remove("alert-success")
        newAlert.classList.add("alert-danger")
    }
    alertsContainer.append(newAlert);
}

function resetForm(form){
    form.reset();
    form.querySelector('select').closest('.mt-3').classList.remove('d-none');
    form.elements['name'].classList.remove('form-control-plaintext');
    form.elements['desc'].classList.remove('form-control-plaintext');

}

async function moveBtnHandler(event){
    let taskElement = event.target.closest('.task');
    let currentTable = event.target.closest('tbody');
    let targetTable = document.getElementById(currentTable.id == 'to-do-list' ? 'done-list' : 'to-do-list');
    
    let taskCounterElement = taskElement.closest('.card').querySelector('.task-counter');
    taskCounterElement.innerHTML = Number(taskCounterElement.innerHTML) - 1;
    
    targetTable.append(taskElement);
    
    taskCounterElement = taskElement.closest('.card').querySelector('.task-counter');
    taskCounterElement.innerHTML = Number(taskCounterElement.innerHTML) + 1;

    let url =`http://tasks-api.std-900.ist.mospolytech.ru/api/tasks/${taskElement.id}?api_key=50d2199a-42dc-447d-81ed-d68a443b697e`;

    let formData = new FormData();
    formData.append("status", currentTable.id == 'to-do-list' ? 'done' : 'to-do')
    let response = await fetch(url, {method: 'PUT',
        body: formData});
    if (response.ok) {
        let result = await response.json();
    }
    else
        showMsg("Ошибка HTTP: " + response.status, "not");
}

function createTaskElement(form){
    let newtaskElement = document.getElementById('task-template').cloneNode(true);
    form.elements['task-id'].value = taskCounter;
    newtaskElement.id = taskCounter++;
    newtaskElement.querySelector('.task-name').textContent = form.elements['name'].value;
    newtaskElement.querySelector('.task-description').textContent = form.elements['desc'].value;
    newtaskElement.classList.remove('d-none');

    for (let btn of newtaskElement.querySelectorAll('.move-btn')){
        btn.onclick = moveBtnHandler;
    }
    return newtaskElement;
}

function setFormValue(form, taskid){
    let taskElement = document.getElementById(taskid);
    form.elements['name'].value = taskElement.querySelector('.task-name').textContent;
    form.elements['desc'].value = taskElement.querySelector('.task-description').textContent;
    form.elements['task-id'].value = taskid;
}

async function uploadData(form){
    let url = "http://tasks-api.std-900.ist.mospolytech.ru/api/tasks?api_key=50d2199a-42dc-447d-81ed-d68a443b697e";
    let formData = new FormData();
    formData.append("desc", form.elements['desc'].value)
    formData.append("id", form.elements['task-id'].value)
    formData.append("name", form.elements['name'].value)
    formData.append("status", form.elements['column'].value.toString())
    let response = await fetch(url, {method: 'POST',
        body: formData});
    if (response.ok) {
        let result = await response.json();
    }
    else
        showMsg("Ошибка HTTP: " + response.status, "not");

}

async function updateTask(form){
    let url =`http://tasks-api.std-900.ist.mospolytech.ru/api/tasks/${form.elements['task-id'].value}?api_key=50d2199a-42dc-447d-81ed-d68a443b697e`;
    let taskElement = document.getElementById(form.elements['task-id'].value);
    taskElement.querySelector('.task-name').textContent = form.elements['name'].value;
    taskElement.querySelector('.task-description').textContent = form.elements['desc'].value;
    let formData = new FormData();
    formData.append("desc", form.elements['desc'].value)
    formData.append("id", form.elements['task-id'].value)
    formData.append("name", form.elements['name'].value)
    formData.append("status", form.elements['column'].value.toString())
    let response = await fetch(url, {method: 'PUT',
        body: formData});
    if (response.ok) {
        let result = await response.json();
    }
    else
        showMsg("Ошибка HTTP: " + response.status, "not");
}

async function removeTaskBtnHandler(event){
    let form = event.target.closest('.modal').querySelector('form');
    let taskElement = document.getElementById(form.elements['task-id'].value);

    let taskCounterElement = taskElement.closest('.card').querySelector('.task-counter');
    taskCounterElement.innerHTML = Number(taskCounterElement.innerHTML) - 1;
    let url =`http://tasks-api.std-900.ist.mospolytech.ru/api/tasks/${taskElement.id}?api_key=50d2199a-42dc-447d-81ed-d68a443b697e`;
    let formData = new FormData();
    formData.append("id", taskElement.id)
    let response = await fetch(url, {method: 'DELETE',
        body: formData});
    if (response.ok) {

    }

    else
        showMsg("Ошибка HTTP: " + response.status, "not");
    taskElement.remove();
}

function actionTaskBtnHandler(event){
    let alertMsg;
    let form = this.closest('.modal').querySelector('form');
    let action = form.elements['action'].value;

    if (action == 'new'){
        let taskElement = document.getElementById(`${form.elements['column'].value}-list`);
        taskElement.append(createTaskElement(form));
        uploadData(form);
        alertMsg = `Задача ${form.elements['name'].value} создана успешно!`;


        let taskCounterElement = taskElement.closest('.card').querySelector('.task-counter');
        taskCounterElement.innerHTML = Number(taskCounterElement.innerHTML) + 1;
        form.reset()
    }
    else if (action == 'edit'){
        updateTask(form);
        alertMsg = `Задача ${form.elements['name'].value} обновлена успешно!`;
    }

    if(alertMsg) showMsg(alertMsg);
}

let taskCounter = 0;

titles = {
    'new':"Создание новой задачи",
    'edit':"Редактирование задачи",
    'show':"Просмотр задачи"
};

actionBtnText = {
    'new':"Создать",
    'edit':"Сохранить",
    'show':"Ок"
};

function createDownloadTaskElement(task){
    let newtaskElement = document.getElementById('task-template').cloneNode(true);
    newtaskElement.id = task.id;
    if (taskCounter <= task.id) {
        taskCounter = task.id;
        taskCounter++;
    }

    newtaskElement.querySelector('.task-name').textContent = task.name;
    newtaskElement.querySelector('.task-description').textContent = task.desc;
    newtaskElement.classList.remove('d-none');

    for (let btn of newtaskElement.querySelectorAll('.move-btn')){
        btn.onclick = moveBtnHandler;
    }
    return newtaskElement;
}

async function downloadData(){
    let url = "http://tasks-api.std-900.ist.mospolytech.ru/api/tasks?api_key=50d2199a-42dc-447d-81ed-d68a443b697e";
    let response =  await fetch(url);
    if (response.ok){
        let answer = await response.json();
        for(i = 0; i < answer.tasks.length; i++){
            let taskElement = document.getElementById(`${answer.tasks[i].status}-list`);
            taskElement.append(createDownloadTaskElement(answer.tasks[i]))
            let taskCounterElement = taskElement.closest('.card').querySelector('.task-counter');
            taskCounterElement.innerHTML = Number(taskCounterElement.innerHTML) + 1;
        }
    }
    else
        showMsg("Ошибка HTTP: " + response.status, "not");
}

window.onload = function(){
    document.querySelector('.action-task-btn').onclick = actionTaskBtnHandler;
    var taskModal = document.getElementById('task-modal');
    taskModal.addEventListener('show.bs.modal' , function(event){
        let form = event.target.querySelector('form');
        resetForm(form);
        let action = event.relatedTarget.dataset.action || "new";
        form.elements['action'].value = action;
        this.querySelector('.modal-title').textContent = titles[action];
        this.querySelector('.action-task-btn').textContent = actionBtnText[action];
        if (action == 'edit' || action == 'show'){
            this.querySelector('select').closest('.mt-3').classList.add('d-none');
            setFormValue(form, event.relatedTarget.closest('.task').id);
        }
        if (action == 'show'){
            form.elements['name'].classList.add('form-control-plaintext');
            form.elements['desc'].classList.add('form-control-plaintext');
        }
    });

    var removeTaskModal = document.getElementById('remove-task-modal');
    removeTaskModal.addEventListener('show.bs.modal' , function(event){
        let taskElement = event.relatedTarget.closest('.task');
        let form = event.target.querySelector('form');
        form.elements['task-id'].value = taskElement.id;
        event.target.querySelector('.task-name').textContent = taskElement.querySelector('.task-name').textContent;
    });

    document.querySelector('.remove-task-btn').onclick = removeTaskBtnHandler;

    downloadData();
    
}