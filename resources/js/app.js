import './bootstrap';
import { createApp } from 'vue';
import TaskList from './components/Tasklist.vue';
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});
app.component('task-list', TaskList);
app.component('task-form', Taskform );
app.component('task-item', TaskItem);
app.component('example-component', ExampleComponent);
app.mount('#app');
