/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

// const messages_el = document.getElementById('messages');
// const username_input = document.getElementById("username");
// const message_input = document.getElementById("username");

// message_form.addEventListener("submit", function (e){
//     e.preventDefault();
    
//     let has_errors = false;

//     if(username_input.value == ""){
//         alert("please enter a username");
//         has_errors = true;
//     };

//     if(message_input.value == ""){
//         alert("please enter a message");
//         has_errors = true;
//     };

//     if(has_errors){
//         return;
//     }

//     const options = {
//         method: "post",
//         url:"/send-message",
//         data:{
//             username: username_input.value,
//             message: message_input.value
//         }
//     }

//     axios(options);
// })

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');
require('./components/Registro.js');
//Vue.component('chat-messages', require('./components/ChatMessages.vue'));
//Vue.component('chat-form', require('./components/ChatForm.vue'));

// const app = new Vue({
//     el: '#app',

//     data: {
//         messages: []
//     },

//     created() {
//         this.fetchMessages();

//         Echo.private('chat')
//         .listen('MessageSent', (e) => {
//             this.messages.push({
//             message: e.message.message,
//             user: e.user
//             });
//         });
//     },

//     methods: {
//         fetchMessages() {
//             axios.get('/messages').then(response => {
//                 this.messages = response.data;
//             });
//         },

//         addMessage(message) {
//             this.messages.push(message);

//             axios.post('/messages', message).then(response => {
//               console.log(response.data);
//             });
//         }
//     }
// });

// window.Echo.channel("chat")
//     .listen(".message", (e) =>{
//         messages_el.innerHTML += '<div class="message"><strong>' + e.username + ':</strong>' + e.message + '</div>';
//     })