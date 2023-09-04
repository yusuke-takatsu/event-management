import type { Meta, StoryObj } from '@storybook/react'
import { LoginForm } from './LoginForm'

const meta = {
  title: 'feature/auth/LoginForm',
  component: LoginForm,
} satisfies Meta<typeof LoginForm>

export default meta

type Story = StoryObj<typeof LoginForm>

export const EmployeeLoginForm: Story = {
  args: {},
}
