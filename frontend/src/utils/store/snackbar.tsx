import { useCallback } from 'react'
import { RecoilAtomKeys } from './recoilKeys'
import { atom, useRecoilState } from 'recoil'

type SnackbarState = {
  isOpen: boolean
  text: string
  severity: string
}

type SnackbarParams = Pick<SnackbarState, 'text' | 'severity'>

export const snackbarStateAtom = atom<SnackbarState>({
  key: RecoilAtomKeys.SNACKBAR_STATE,
  default: {
    isOpen: false,
    text: '',
    severity: 'info',
  },
})

export const useSnackbarState = () => {
  const [snackbarState, setSnackbarState] = useRecoilState(snackbarStateAtom)

  const openSnackbar = useCallback(
    ({ text, severity }: SnackbarParams) => {
      setSnackbarState({
        isOpen: true,
        text,
        severity,
      })
    },
    [setSnackbarState]
  )

  const closeSnackbar = useCallback(() => {
    setSnackbarState({
      isOpen: false,
      text: '',
      severity: 'info',
    })
  }, [setSnackbarState])

  return { snackbarState, openSnackbar, closeSnackbar }
}
