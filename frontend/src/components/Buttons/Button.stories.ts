import type { Meta, StoryObj } from '@storybook/react'
import { Button } from './Button'

const meta = {
  title: 'Button',
  component: Button,
} satisfies Meta<typeof Button>

export default meta

type Story = StoryObj<typeof Button>

export const BaseButton: Story = {
  args: {
    variant: 'text',
    color: 'primary',
    children: 'Base Button',
    startIcon: null,
    endIcon: null,
    size: 'medium',
    type: 'button',
    className: '',
    isDisabled: true,
    isLoading: true,
    fullWidth: false,
  },
}
