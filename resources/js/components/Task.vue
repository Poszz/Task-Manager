<template>
    <div class="task">
      <input 
        type="checkbox" 
        :checked="status === 'Done'" 
        @change="toggleDone"
      >
      <span :class="{ 'task-done': status === 'Done' }">{{ title }}</span>
      <select :value="status" @change="updateStatus($event.target.value)">
        <option v-for="option in statusOptions" :key="option" :value="option">
          {{ option }}
        </option>
      </select>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import axios from 'axios';

  const props = defineProps({
    id: {
      type: Number,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    initialStatus: {
      type: String,
      default: 'To Do'
    }
  });

  const status = computed({
    get: () => props.initialStatus,
    set: (newValue) => {
      updateStatus(newValue);
    }
  });

  const statusOptions = ['To Do', 'In Progress', 'Done'];

  function updateStatus(newStatus) {
    status.value = newStatus;
    sendUpdate();
  }

  function toggleDone() {
    status.value = status.value === 'Done' ? 'To Do' : 'Done';
    sendUpdate();
  }

  function sendUpdate() {
    axios.patch(`/api/tasks/${props.id}`, { status: status.value })
      .then(response => {
        // Handle success
        console.log('Task updated successfully');
      })
      .catch(error => {
        // Handle error
        console.error('Error updating task:', error);
          // Revert the status if the update fails
      status.value = props.initialStatus;
      });
  }
  </script>
  
  <style scoped>
  .task-done {
    text-decoration: line-through;
    color: #888;
  }

  </style>