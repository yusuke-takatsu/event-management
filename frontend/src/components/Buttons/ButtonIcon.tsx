import IconButton from '@mui/material/IconButton'
import CloseIcon from '@mui/icons-material/Close'
import UnfoldMoreSharpIcon from '@mui/icons-material/UnfoldMoreSharp'
import { ButtonProps as MuiButtonProps } from '@mui/material/Button'

type MuiButtonColors = MuiButtonProps['color']

interface ButtonIconProps {
  className?: string
  onClick?: (event: React.MouseEvent<HTMLButtonElement>) => void
  color?: MuiButtonColors
  size?: 'small' | 'medium' | 'large'
  isFavorite?: boolean
}

export const ButtonIconClose: React.FC<ButtonIconProps> = ({
  className,
  onClick,
  color,
  size,
}) => {
  return (
    <div className={className}>
      <IconButton color={color} size={size} onClick={onClick}>
        <CloseIcon />
      </IconButton>
    </div>
  )
}

export const ButtonIconArrowUpAndDown: React.FC<ButtonIconProps> = ({
  className,
  onClick,
  color,
  size,
}) => {
  return (
    <div className={className}>
      <IconButton color={color} size={size} onClick={onClick}>
        <UnfoldMoreSharpIcon />
      </IconButton>
    </div>
  )
}
