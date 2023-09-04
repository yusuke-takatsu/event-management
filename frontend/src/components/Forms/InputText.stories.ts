// InputText.stories.ts
import type { Meta, StoryObj } from '@storybook/react'
import { InputText } from './InputText'

const meta = {
  title: 'Forms/InputText',
  component: InputText,
} satisfies Meta<typeof InputText>

export default meta

type Story = StoryObj<typeof InputText>

export const TopLabelInputText: Story = {
  args: {
    type: 'email',
    placeholder: 'ここに文字が入ります',
    label: 'メールアドレス',
    labelPosition: 'top',
  },
}

export const LeftLabelInputText: Story = {
  args: {
    type: 'text',
    placeholder: 'ここに文字が入ります',
    label: '氏名',
    labelPosition: 'left',
  },
}

export const ErrorInputText: Story = {
  args: {
    type: 'password',
    placeholder: 'ここに文字が入ります',
    label: 'パスワード',
    value: 'test1234',
    labelPosition: 'top',
    error: true,
    helperText: '※パスワードが違います',
  },
}
