import { Meta, StoryObj } from '@storybook/react'
import { BasicSnackbar } from '.'
import { useSnackbarState } from '@/utils/store/snackbar'
import { Button } from '../Buttons'

const BasicSnackbarWithHook = () => {
  const { openSnackbar } = useSnackbarState()

  const onClick = () => {
    openSnackbar({
      text: '変更が完了しました',
      severity: 'success',
    })
  }

  const onClickError = () => {
    openSnackbar({
      text: 'エラーが発生しました',
      severity: 'error',
    })
  }

  return (
    <>
      <Button onClick={onClick}>スナックバー（正常）</Button>
      <Button onClick={onClickError} color="error">
        スナックバー（異常）
      </Button>
      <BasicSnackbar />
    </>
  )
}

export default {
  title: 'Snackbars/BasicSnackbar',
  component: BasicSnackbar,
} as Meta

type Story = StoryObj<typeof BasicSnackbarWithHook>

export const BaseSnackbar: Story = {}
