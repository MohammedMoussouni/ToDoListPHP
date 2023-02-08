const formAddTask = document.querySelector('#formAddTask'); //querySelector ou getElementById pour récupérer le formulaire présent sur index.php
const tableTasks = document.querySelector('.table'); // récupérer par sa classe .table
const inputTaskName = document.querySelector('#inputTaskName');// # pour récupérer l'ID
const checkboxes = document.querySelectorAll('.form-check-input'); //. pour récupérer une classe
const deletebtn = document.querySelectorAll('.btnsupp');
//const btnsuppr = document.createElement('input');

const URL_ACTIONS = 'actions.php';


formAddTask.addEventListener('submit', async function(e)
{
    e.preventDefault();

    const formData = new FormData(e.target);

    //utiliser la methode POST pour envoyer une tâche
    await fetch(URL_ACTIONS, {
        method: 'POST',
        body: formData,
        url: 'http://localhost/'
    })
        .then(data => data.json())
        .then(json => {
            if (json.code !== 'ADD_TASK_OK') return;

            const row = tableTasks.insertRow();
            const firstCell = row.insertCell();
            const secondCell = row.insertCell();
            const thirdCell = row.insertCell();

            firstCell.classList.add('text-center');
            thirdCell.classList.add('text-center');

            const checkbox = document.createElement('input');
            const deletebutton = document.createElement('button');
            const taskName = document.createTextNode(json.taskName);
            
            checkbox.type = 'checkbox';
            //deletebutton.type = 'button';
            checkbox.classList.add('form-check-input');
            deletebutton.classList.add('btnsupp');
            deletebutton.textContent='Supprimer';
            checkbox.dataset.id = json.taskId;
            deletebutton.dataset.id =json.taskId;


            //astuce copier une ligne (ALT+MAJ+ flèche du bas)
            firstCell.appendChild(checkbox); 
            secondCell.appendChild(taskName);
            thirdCell.appendChild(deletebutton);
            


            checkbox.addEventListener('change', updateTask);
            deletebutton.addEventListener('click', removeTasks);

            inputTaskName.value = '';

           
        }).catch(err => {
            // Do something for an error here
            console.log("Error Reading data " + err);
          });
        

   //créer une fonction asynchrone sur l'evenement submit


});



const updateTask = async function (e) //fonction asynchrone permet de mettre à jour sans rafraichir la page
{
        await fetch(URL_ACTIONS,
        {
            method : 'PUT', // action de mise à jour
            body : JSON.stringify({   //stringify d'un objet
                                    action: 'update_task',
                                    done: this.checked, // récupérer la propriété checked de notre checked box
                                    taskId: this.dataset.id
                                })
        })
}


checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateTask);
})






const removeTasks = async function (e) //fonction asynchrone permet de mettre à jour sans rafraichir la page
{
        await fetch(URL_ACTIONS,
        {
            method : 'PUT', // action de mise à jour
            body : JSON.stringify({   //stringify d'un objet
                                    action: 'delete_task',
                                    //done: this.checked,
                                    taskId: this.dataset.id
                                })
        })
        window.location.reload();
        console.log ("Entrée n°"+this.dataset.id+" supprimée");
}



deletebtn.forEach(deletebutton => {
    deletebutton.addEventListener('click', removeTasks);
})






