import '@/styles/globals.css'
import type { AppProps } from 'next/app'
import { SWRConfig } from 'swr'
import { ThemeProvider as MUIThemeProvider } from '@mui/material/styles'
import { theme, createEmotionCache } from '../utils'
import { EmotionCache } from '@emotion/cache'
import { CacheProvider } from '@emotion/react'
import { axios } from '@/utils/axiosClient'
import { isCommonErrorResponse } from '@/utils/helpers/handleErrors'
import { RecoilRoot } from 'recoil'
import { BasicSnackbar } from '@/components/Snackbars'

const clientSideEmotionCache = createEmotionCache()

interface MyAppProps extends AppProps {
  emotionCache?: EmotionCache
}

export default function App(props: MyAppProps) {
  const { Component, emotionCache = clientSideEmotionCache, pageProps } = props

  const swrConfigValue = {
    fetcher: async (url: string) => {
      try {
        const response = await axios.get(url)
        return response.data
      } catch (error) {
        if (!isCommonErrorResponse(error)) return
      }
    },
  }

  return (
    <CacheProvider value={emotionCache}>
      <MUIThemeProvider theme={theme}>
        <SWRConfig value={swrConfigValue}>
          <RecoilRoot>
            <Component {...pageProps} />
            <BasicSnackbar />
          </RecoilRoot>
        </SWRConfig>
      </MUIThemeProvider>
    </CacheProvider>
  )
}
