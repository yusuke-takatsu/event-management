import { styled } from '@mui/material/styles'
import { fontSize, fontWeight, textColor } from '@/utils/themeClient'

export const BaseTitle = styled('div')`
  color: ${textColor.black};
  font-size: ${fontSize.xxl};
  font-weight: ${fontWeight.bold};
  white-space: pre-line;
  word-break: break-all;
  line-height: 1.5;
  &.-left {
    text-align: left;
  }
  &.-end {
    text-align: end;
  }
  &.-center {
    text-align: center;
  }
  &.-full {
    width: 100%;
  }
`
