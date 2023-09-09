import { CommonErrorResponse, ErrorResponse } from '../types/error'

export const isCommonErrorResponse = (
  error: any
): error is CommonErrorResponse => {
  return typeof error.status === 'number' && typeof error.message === 'string'
}

export const isErrorResponse = (error: unknown): error is ErrorResponse => {
  return (
    typeof error === 'object' &&
    error !== null &&
    'data' in error &&
    typeof (error as ErrorResponse).data.message === 'string'
  )
}
