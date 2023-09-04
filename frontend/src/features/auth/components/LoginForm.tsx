import styled from '@emotion/styled'
import { useForm } from 'react-hook-form'
import { bgColor, fontSize, fontWeight } from '@/utils/themeClient'
import { Button } from '@/components/Buttons'
import Link from 'next/link'
import { BaseTitle, BaseText } from '@/theme'
import { InputText } from '@/components/Forms'
import { z } from 'zod'
import { zodResolver } from '@hookform/resolvers/zod'
import { useState } from 'react'

const Wrapper = styled('div')`
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
`

const LoginContainer = styled('div')`
  margin: -136px auto 0;
`

const FormTitle = styled(BaseText)`
  margin-top: 100px;
  margin-bottom: 8px;
`

const StyledForm = styled('form')`
  width: 520px;
  background-color: ${bgColor.brightGray};
  padding: 40px 60px 48px;
  border-radius: 4px;
`

const StyledButton = styled(Button)`
  margin-top: 32px;
`

const StyledLink = styled(Link)`
  display: block;
  text-align: center;
  margin-top: 38px;
  font-size: ${fontSize.sm};
  font-weight: ${fontWeight.bold};
`

const schema = z.object({
  email: z
    .string()
    .nonempty('メールアドレスは必須です。')
    .email({ message: 'メールアドレスの形式が正しくありません。' }),
  password: z
    .string()
    .nonempty('パスワードは必須です。')
    .min(8, 'パスワードは8文字以上である必要があります。')
    .max(255, 'パスワードは255文字以下である必要があります。')
    .refine(
      (value) =>
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~])[!-~]*$/.test(
          value
        ),
      'パスワードは、大文字、小文字、数字、記号の全てが含まれたものである必要があります。'
    ),
})

type LoginParams = z.infer<typeof schema>

export const LoginForm = () => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<LoginParams>({
    resolver: zodResolver(schema),
  })

  const [isLoading, setIsLoading] = useState(false)

  const login = async (data: any) => {
    setIsLoading(true)

    try {
      await new Promise((resolve, reject) => {})
    } catch (e) {
      console.log(e)
    } finally {
      setIsLoading(false)
    }
  }

  return (
    <Wrapper>
      <LoginContainer>
        <BaseTitle className="-center">イベント管理システム</BaseTitle>
        <FormTitle className="-bold -center -large">ログイン</FormTitle>
        <StyledForm onSubmit={handleSubmit(login)}>
          <InputText
            type="text"
            label="メールアドレス"
            autoComplete="email"
            register={register('email')}
            sx={{ mb: 3 }}
            error={errors.email !== undefined}
            helperText={errors.email?.message}
          />
          <InputText
            type="password"
            label="パスワード"
            autoComplete="current-password"
            register={register('password')}
            sx={{ mb: 3 }}
            error={errors.password !== undefined}
            helperText={errors.password?.message}
          />
          <StyledButton type="submit" fullWidth isLoading={isLoading}>
            ログイン
          </StyledButton>
          <StyledLink href="/">パスワードをお忘れの方</StyledLink>
        </StyledForm>
      </LoginContainer>
    </Wrapper>
  )
}
