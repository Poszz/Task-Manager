<template>
    <div class="bg-blue-100 rounded-lg p-6 mt-4 shadow-sm">
        <h2 class="text-2xl font-semibold text-blue-700 mb-2">Vue Component</h2>
        <p class="text-lg text-gray-700">@{{ vueMessage }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            vueMessage: 'Hello from Vue!'
        }
    }
}
</script>