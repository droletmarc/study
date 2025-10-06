import {describe, it, expect, vi} from 'vitest'
import {mount} from '@vue/test-utils'
import Counter from '../Counter.vue'

describe('Counter.vue', () => {
  // can be globally mounted if needed
  const wrapper = mount(Counter)

  it('renders the component', () => {
    expect(wrapper.text()).toContain('Count: 0')
  })

  it('increments the count when button is clicked', async () => {
    await wrapper.find('button').trigger('click')
    expect(wrapper.text()).toContain('Count: 1')
  })

  it('calls the increment method when button is clicked', async () => {
    const incrementSpy = vi.spyOn(Counter.methods, 'increment')
    await wrapper.find('button').trigger('click')
    expect(incrementSpy).toHaveBeenCalled()
    incrementSpy.mockRestore()
  })
})
