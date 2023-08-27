import { Html, Head, Main, NextScript } from 'next/document'

export default function Document() {
  return (
    <Html lang="ja">
      <Head>
        <meta name="form-detection" content="telephone=no" />
        <meta name="robots" content="noindex,nofollow" />
      </Head>
      <body>
        <Main />
        <NextScript />
      </body>
    </Html>
  )
}
