import Axios, { AxiosError, InternalAxiosRequestConfig } from 'axios'

const NODE_ENV = process.env.NODE_ENV

const useAuthRequestInterceptor = (config: InternalAxiosRequestConfig) => {
  if (config.headers) {
    config.headers.Accept = 'application/json'
  }
  return config
}

const params = {
  baseURL: process.env.NEXT_PUBLIC_API_URL,
  withCredentials: true,
}

export const axios = Axios.create(params)

axios.interceptors.request.use(useAuthRequestInterceptor)
axios.interceptors.response.use(
  (response) => {
    if (
      process.env.NEXT_PUBLIC_APP_URL !==
      process.env.NEXT_PUBLIC_PRODUNCTION_URL
    ) {
      console.log(response.data, response.config.url)
    }

    return response.data
  },
  (error: AxiosError) => {
    if (NODE_ENV !== 'production') {
      console.log(error, 'axios error')
    }

    return Promise.reject(error.response)
  }
)
