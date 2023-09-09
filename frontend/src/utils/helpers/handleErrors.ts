import { CommonErrorResponse } from '../types/error'

export const isCommonErrorResponse = (
  error: any
): error is CommonErrorResponse => {
  return typeof error.status === 'number' && typeof error.message === 'string'
}
