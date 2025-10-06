<script>
import { ref } from 'vue'
export default {
  name: 'Counter',
  props: {
    modelValue: {
      type: Number,
      required: true
    }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const count = ref(props.modelValue)

    function increment() {
      count.value++
      emit('update:modelValue', count.value)
    }

    function decrement() {
      count.value--
      emit('update:modelValue', count.value)
    }

    return { count, increment, decrement }
  }
}
</script>

<template>
  <div class="counter">
    <button @click="decrement">-</button>
    <span>{{ count }}</span>
    <button @click="increment">+</button>
  </div>
</template>

<style scoped>
.counter {
  display: flex;
  align-items: center;
}
button {
  width: 30px;
  height: 30px;
  font-size: 20px;
}
span {
  margin: 0 10px;
  font-size: 20px;
}
</style>
