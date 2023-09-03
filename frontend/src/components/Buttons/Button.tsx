import React, { ReactNode, useCallback, useRef } from 'react'
import './button.css'
import MuiButton, { ButtonProps as MuiButtonProps } from '@mui/material/Button'
import MuiCircularProgress from '@mui/material/CircularProgress'
import styled from '@emotion/styled'

/**
 * Primary UI component for user interaction
 */

const CustomMuiButton = styled(MuiButton)<{ variant?: string; color?: string }>`
  color: ${({ variant, color }: { variant?: string; color?: string }) => {
    if (variant === 'contained' && color !== 'primary') {
      return 'white'
    }
    return null
  }};
  &.-full-height {
    height: 100%;
  }
`

const CustomMuiCircularProgress = styled(MuiCircularProgress)<{
  className?: string
}>`
  color: ${({ className }) => (className === 'contained' ? 'white' : null)};
`

type MuiButtonColors = MuiButtonProps['color']

interface ButtonProps
  extends Pick<MuiButtonProps, Exclude<keyof MuiButtonProps, 'color'>> {
  variant?: 'text' | 'contained' | 'outlined'
  color?: MuiButtonColors
  children: ReactNode
  startIcon?: ReactNode
  endIcon?: ReactNode
  size?: 'small' | 'medium' | 'large'
  type?: 'button' | 'submit' | 'reset'
  className?: string
  isDisabled?: boolean
  isLoading?: boolean
  onClick?: (event: React.MouseEvent<HTMLButtonElement>) => void
  fullWidth?: boolean
}

export const Button: React.FC<ButtonProps> = ({
  className,
  children,
  startIcon,
  endIcon,
  type = 'button',
  color = 'primary',
  size = 'medium',
  variant = 'contained',
  isDisabled,
  isLoading = false,
  onClick,
  fullWidth = false,
}: ButtonProps) => {
  // 多重送信防止用(3秒間はボタンをクリックできない)
  const processing = useRef(false)
  const handleButton = useCallback(
    (event: React.MouseEvent<HTMLButtonElement>) => {
      if (processing.current) return
      processing.current = true

      if (onClick) onClick(event)

      setTimeout(() => {
        processing.current = false
      }, 3000)
    },
    [onClick]
  )

  return (
    <CustomMuiButton
      variant={variant}
      color={color}
      size={size}
      type={type}
      className={className}
      onClick={handleButton}
      disabled={isDisabled}
      fullWidth={fullWidth}
      startIcon={startIcon}
      endIcon={endIcon}
    >
      {!isLoading && <p>{children}</p>}
      {isLoading && <CustomMuiCircularProgress className={variant} size={25} />}
    </CustomMuiButton>
  )
}
