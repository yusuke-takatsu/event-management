import { z } from 'zod'

const EmailValidation = z
  .string()
  .nonempty('メールアドレスは必須です。')
  .email({ message: 'メールアドレスの形式が正しくありません。' })

export const EmailSchema = z.object({
  email: EmailValidation,
})

const PasswordValidation = z
  .string()
  .nonempty('パスワードは必須です。')
  .min(8, 'パスワードは8文字以上である必要があります。')
  .max(255, 'パスワードは255文字以下である必要があります。')

export const PasswordSchema = z.object({
  password: PasswordValidation,
})

export const LoginSchema = z.object({
  email: EmailValidation,
  password: PasswordValidation,
})

export type LoginParams = z.infer<typeof LoginSchema>
