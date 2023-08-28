import '@/styles/globals.css'
import type { AppProps } from 'next/app'
import { SWRConfig } from 'swr'

export default function App({ Component, pageProps }: AppProps) {
  const swrConfigValue = {
    fetcher: (url: string) => fetch(`${url}`).then((res) => res.json()),
  }

  return (
    <SWRConfig value={swrConfigValue}>
      <Component {...pageProps} />
    </SWRConfig>
  )
}
