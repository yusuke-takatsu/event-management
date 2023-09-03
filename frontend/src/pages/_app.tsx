import '@/styles/globals.css'
import type { AppProps } from 'next/app'
import { SWRConfig } from 'swr'
import { ThemeProvider as MUIThemeProvider } from '@mui/material/styles'
import { theme, createEmotionCache } from '../utils'
import { EmotionCache } from '@emotion/cache'
import { CacheProvider } from '@emotion/react'

const clientSideEmotionCache = createEmotionCache()

interface MyAppProps extends AppProps {
  emotionCache?: EmotionCache
}

export default function App(props: MyAppProps) {
  const { Component, emotionCache = clientSideEmotionCache, pageProps } = props

  const swrConfigValue = {
    fetcher: (url: string) => fetch(`${url}`).then((res) => res.json()),
  }

  return (
    <CacheProvider value={emotionCache}>
      <MUIThemeProvider theme={theme}>
        <SWRConfig value={swrConfigValue}>
          <Component {...pageProps} />
        </SWRConfig>
      </MUIThemeProvider>
    </CacheProvider>
  )
}
