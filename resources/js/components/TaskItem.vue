<template>
    <li class="bg-white p-4 rounded shadow mb-4">
        <div v-if="!editing">
            <h4 class="font-bold">{{ task.title }}</h4>
            <p class="text-gray-600">{{ task.description }}</p>
            <p class="text-sm text-gray-500">Due: {{ task.due_date }}</p>
            <div class="mt-2">
                <button @click="startEdit" class="text-blue-500 mr-2">Edit</button>
                <button @click="deleteTask" class="text-red-500">Delete</button>
            </div>
        </div>
        <div v-else>
            <input v-model="editedTask.title" class="border p-1 mb-2 w-full">
            <textarea v-model="editedTask.description" class="border p-1 mb-2 w-full"></textarea>
            <input v-model="editedTask.due_date" type="date" class="border p-1 mb-2">
            <input type="checkbox" :checked="task.is_completed" @change="toggleCompletion" @click.prevent>
            {{ task.title }}
            <select v-model="task.status" @change="updateStatus" class="border rounded p-1">
                    <option value="not_started">Not Started</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
            </select>
            <div>
                <button @click="saveEdit" class="bg-blue-500 text-white px-2 py-1 rounded mr-2">Save</button>
                <button @click="cancelEdit" class="bg-gray-500 text-white px-2 py-1 rounded">Cancel</button>
            </div>
        </div>
    </li>
</template>

<script>
import axios from 'axios';

export default {
    props: ['task'],
    data() {
        return {
            editing: false,
            editedTask: { ...this.task }
        }
    },
    methods: {
        startEdit() {
            this.editing = true;
        },
        cancelEdit() {
            this.editing = false;
            this.editedTask = { ...this.task };
        },
        saveEdit() {
            axios.put(`/api/tasks/${this.task.id}`, this.editedTask)
                .then(response => {
                    this.$emit('task-updated', response.data);
                    this.editing = false;
                })
                .catch(error => {
                    console.error('Error updating task:', error);
                });
        },
        deleteTask() {
            if (confirm('Are you sure you want to delete this task?')) {
                axios.delete(`/api/tasks/${this.task.id}`)
                    .then(() => {
                        this.$emit('task-deleted', this.task.id);
                    })
                    .catch(error => {
                        console.error('Error deleting task:', error);
                    });
            }
        },
        toggleCompletion() {
            const updatedTask = { ...this.task, is_completed: !this.task.is_completed };
      axios.put(`/api/tasks/${this.task.id}`, updatedTask)
        .then(response => {
          this.task.is_completed = response.data.is_completed;
          this.$emit('task-updated', response.data);
        })
        .catch(error => {
          console.error('Error updating task completion status:', error);
                });
        }

    }
}
</script>