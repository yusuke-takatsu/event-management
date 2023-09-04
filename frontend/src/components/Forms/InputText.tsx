import styled from '@emotion/styled'
import { TextField, TextFieldProps } from '@mui/material'
import { UseFormRegisterReturn } from 'react-hook-form'
import { bgColor, fontSize, fontWeight, lineHeight } from '@/utils/themeClient'

const baseHeightPx = '31px'

const Wrapper = styled('div')<{ labelPosition?: 'top' | 'left' }>`
  display: ${({ labelPosition }) =>
    labelPosition === 'left' ? 'flex' : 'block'};
  width: 100%;
  font-size: ${fontSize.sm};
  font-weight: ${fontWeight.normal};
  line-height: ${lineHeight.sm};
`

const BaseLabel = styled('label')`
  user-select: none;
  white-space: nowrap;
  cursor: pointer;
`

const TopLabel = styled(BaseLabel)`
  display: block;
`

const LeftLabel = styled(BaseLabel)`
  height: ${baseHeightPx};
  line-height: ${baseHeightPx};
  margin-right: 14px;
  font-weight: ${fontWeight.bold};
`

const CustomTextField = styled(TextField)<{ placeholderColor?: string }>`
  width: 100%;

  .MuiOutlinedInput-root {
    background: ${bgColor.white};
  }
  .MuiInputBase-input {
    color: ${({ placeholderColor }) => placeholderColor || ''};
    padding: 0px 6px;
    height: ${baseHeightPx};
    border-radius: 4px;
  }
  .MuiFormHelperText-root {
    margin: 0;
    font-size: ${fontSize.sm};
    font-weight: ${fontWeight.normal};
    line-height: ${lineHeight.sm};
  }
`

// TextFieldPropsの型をオーバーライド
interface CustomTextFieldProps
  extends Omit<TextFieldProps, 'label' | 'onClick'> {
  placeholderColor?: string
}

// TextField要素以外の型
type AdditionalTextFieldProps = {
  // NOTE:アクション
  onClick?: (event: React.MouseEvent<HTMLInputElement>) => void
  // NOTE:エラーハンドリング
  register?: UseFormRegisterReturn
  //NOTE:追加項目
  label?: string
  labelPosition?: 'top' | 'left'
  maxLength?: number
}

export type InputTextProps = CustomTextFieldProps & AdditionalTextFieldProps

type PositionedLabelProps = {
  label: string
  position: 'top' | 'left'
}

export const InputText = (props: InputTextProps) => {
  const {
    onClick,
    id,
    inputProps,
    register,
    label,
    labelPosition = 'top',
    maxLength = 255,
    ...customTextFieldProps
  } = props

  const PositionedLabel = ({ label, position }: PositionedLabelProps) => {
    switch (position) {
      case 'top':
        return <TopLabel htmlFor={id ?? label}>{label}</TopLabel>
      case 'left':
        return <LeftLabel htmlFor={id ?? label}>{label}</LeftLabel>
      default:
        return null
    }
  }

  return (
    <Wrapper labelPosition={labelPosition} onClick={onClick}>
      {label && <PositionedLabel label={label} position={labelPosition} />}
      <CustomTextField
        id={id ?? label}
        type="text"
        {...customTextFieldProps}
        inputProps={{
          maxLength,
          ...inputProps,
        }}
        {...register}
      />
    </Wrapper>
  )
}
