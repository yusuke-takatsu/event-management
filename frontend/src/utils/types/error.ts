export interface CommonErrorResponse {
  message: string
  status: number
}

export interface ErrorResponse {
  data: {
    message: string
  }
  status: number
}
