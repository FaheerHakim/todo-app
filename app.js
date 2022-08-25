function reload () {
  window.location.reload();
}
let datePicker = document.querySelector(".date-picker");
datePicker.setAttribute("min", new Date().toISOString().split("T")[0]);

document.getElementById("submit-todo").addEventListener("click", function(e){
    e.preventDefault();

  let title = document.querySelector(".todo-list-title").value;
  let formData = new FormData();
  

  formData.append("title", title);

  fetch("AJAX/saveTodoList.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    // TODO: show result when the call is succesful
    console.log(result.body);
  })
  reload();
})

let listID;
let itemID;
let dialog =  document.querySelector(".dialog-wrapper");
dialog.style.display = "none";


document.querySelectorAll(".add-item").forEach(function(button){
  button.addEventListener("click", function(){
    dialog.style.display = "block";
    // set listID for AJAX call
    // To add the item under its parent list element.
    listID = button.dataset.listid;
  })
})

document.querySelector(".add-item-dialog").addEventListener("click", function(e) {
  e.preventDefault();

  let text = document.querySelector(".todo-list-item").value;
  let time = document.querySelector(".time-picker").value;
  let date = datePicker.value;
  let formData = new FormData();


  formData.append("text", text);
  formData.append("listID", listID);
  formData.append("time", time);
  formData.append("date", date);


  fetch("AJAX/saveTodoItem.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    // TODO: show result when the call is succesful
    console.log(result.body);
  })
  reload();
})

document.querySelectorAll(".delete-list").forEach(function(button){
  button.addEventListener("click", function(e){
    e.preventDefault();

    listID = button.dataset.listid;
    let formData = new FormData();
  
    formData.append("listID", listID);
    fetch("AJAX/deleteTodoList.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      // TODO: show result when the call is succesful
      console.log(result.message);
    })
    
    reload();
  })
})

document.querySelectorAll(".delete-item").forEach(function(button){
  button.addEventListener("click", function(e){
    e.preventDefault();

    let itemID = button.dataset.itemid;

    let formData = new FormData();

    formData.append("itemID", itemID);
    fetch("AJAX/deleteTodoItem.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      // TODO: show result when the call is succesful
      console.log(result.message);
    })
    reload();
  })
})

document.querySelectorAll(".add-comment").forEach(function(button){
  button.addEventListener("click", function(e) {
   e.preventDefault();
   document.querySelector(".add-comment-dialog").style.display = "block";
    itemID = button.dataset.itemid;
  })
})

document.querySelector(".add-comment-button").addEventListener("click", function(e){
  e.preventDefault();
  let comment = document.querySelector(".comment-input").value;
  let formData = new FormData();

  formData.append("itemID", itemID);
  formData.append("comment", comment);

  fetch("AJAX/saveComment.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    // TODO: show result when the call is succesful
    console.log(result.body);
  })
  reload();
})

document.querySelectorAll(".unchecked-square").forEach(function(element){
  element.addEventListener("click", function(){
   itemID = element.dataset.itemid;
   let formData = new FormData();
   formData.append("itemID", itemID);
   formData.append("isChecked", 1);
   
   fetch("AJAX/checkItem.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    // TODO: show result when the call is succesful
    console.log(result.message);
  })
  reload();
  })
})

document.querySelectorAll(".checked-square").forEach(function(element){
  element.addEventListener("click", function(){
   itemID = element.dataset.itemid;
   let formData = new FormData();
   formData.append("itemID", itemID);
   formData.append("isChecked", 0);
   
   fetch("AJAX/checkItem.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    // TODO: show result when the call is succesful
    console.log(result.message);
  })
  reload();
  })
})