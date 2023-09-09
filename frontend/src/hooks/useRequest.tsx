import useSwr, { SWRConfiguration, SWRResponse } from 'swr'

export const useRequest = (
  url: string,
  options?: SWRConfiguration
): SWRResponse => {
  const { data, error, ...rest } = useSwr(url, options)

  if (error) throw error

  return { data, error, ...rest }
}
