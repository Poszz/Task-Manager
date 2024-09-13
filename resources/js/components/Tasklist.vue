<template>
    <div>
        <h2>Task List</h2>
        <task-form @task-added="addTask"></task-form>
        <ul>
            <task-item 
                v-for="task in tasks" 
                :key="task.id" 
                :task="task"
                @task-updated="updateTask"
                @task-deleted="deleteTask"
                @task-completed="toggleTaskCompletion"
            ></task-item>
        </ul>
    </div>
</template>

<script>
import Taskform from '@/components/Taskform.vue';
import TaskItem from './TaskItem.vue';
import axios from 'axios';

export default {
    components: {
        Taskform,
        TaskItem
    },
    data() {
        return {
            tasks: []
        }
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.get('/api/tasks')
                .then(response => {
                    this.tasks = response.data;
                });
        },
        addTask(task) {
            this.tasks.push(task);
        },
        updateTask(updatedTask) {
            const index = this.tasks.findIndex(t => t.id === updatedTask.id);
            if (index !== -1) {
                this.tasks.splice(index, 1, updatedTask);
            }
        },
        deleteTask(taskId) {
            this.tasks = this.tasks.filter(t => t.id !== taskId);
        },
        toggleTaskCompletion(task) {
            axios.patch(`/api/tasks/${task.id}`, {
                is_completed: task.is_completed
            })
            .then(response => {
                if (response.data.success) {
                    console.log('Task updated successfully');
                    this.updateTask(task);
                } else {
                    console.error('Failed to update task');
                    task.is_completed = !task.is_completed; // Revert the change if update failed
                }
            })
            .catch(error => {
                console.error('Error:', error);
                task.is_completed = !task.is_completed; // Revert the change if there was an error
            });
        }
    }
}
</script>