import '@/styles/globals.css'
import type { AppProps } from 'next/app'
import { SWRConfig } from 'swr'
import { ThemeProvider as MUIThemeProvider } from '@mui/material/styles'
import { theme } from '../theme'

export default function App({ Component, pageProps }: AppProps) {
  const swrConfigValue = {
    fetcher: (url: string) => fetch(`${url}`).then((res) => res.json()),
  }

  return (
    <MUIThemeProvider theme={theme}>
      <SWRConfig value={swrConfigValue}>
        <Component {...pageProps} />
      </SWRConfig>
    </MUIThemeProvider>
  )
}
