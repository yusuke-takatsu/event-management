import styled from '@emotion/styled'
import { useForm } from 'react-hook-form'
import { bgColor, fontSize, fontWeight } from '@/utils/themeClient'
import { Button } from '@/components/Buttons'
import Link from 'next/link'
import { BaseTitle, BaseText } from '@/theme'
import { InputText } from '@/components/Forms'
import { zodResolver } from '@hookform/resolvers/zod'
import { useState } from 'react'
import { LoginParams, LoginSchema } from '@/utils/types/schemas/auth'
import { statusCode } from '@/utils/constants'
import { axios } from '@/utils/axiosClient'
import { useSnackbarState } from '@/utils/store/snackbar'
import { useRouter } from 'next/router'
import { isErrorResponse } from '@/utils/helpers/handleErrors'

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

const apiUrl = process.env.NEXT_PUBLIC_API_URL

export const LoginForm = () => {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<LoginParams>({
    resolver: zodResolver(LoginSchema),
  })

  const { openSnackbar } = useSnackbarState()
  const [isLoading, setIsLoading] = useState(false)
  const router = useRouter()

  const login = async (data: LoginParams) => {
    setIsLoading(true)

    try {
      await axios.get(`http://localhost:80/sanctum/csrf-cookie`, {})
      await axios.post(`${apiUrl}/login`, data, {})

      router.push('mypage')
    } catch (e) {
      if (isErrorResponse(e)) {
        if (e.status === statusCode.VALIDATION) {
          openSnackbar({
            text: e.data.message,
            severity: 'error',
          })
        }
      }
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
