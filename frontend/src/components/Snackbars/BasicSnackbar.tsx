import { Alert, Snackbar } from '@mui/material'
import { fontSize } from '@/utils/themeClient'
import { useSnackbarState } from '@/utils/store/snackbar'

export const BasicSnackbar = () => {
  const { snackbarState, closeSnackbar } = useSnackbarState()

  return (
    <Snackbar
      open={snackbarState.isOpen}
      autoHideDuration={5000}
      onClose={closeSnackbar}
      anchorOrigin={{
        vertical: 'bottom',
        horizontal: 'center',
      }}
      sx={{
        width: '100%',
        '@media (min-width: 600px)': {
          bottom: 0,
        },
      }}
    >
      <Alert
        severity={snackbarState.severity}
        sx={{
          width: '100%',
          justifyContent: 'center',
          padding: '20px 0',
          fontSize: fontSize.lg,
        }}
      >
        {snackbarState.text}
      </Alert>
    </Snackbar>
  )
}
