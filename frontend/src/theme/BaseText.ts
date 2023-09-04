import { styled } from '@mui/material/styles'
import { textColor, fontSize, fontWeight } from '@/utils/themeClient'

export const BaseText = styled('div')`
  color: ${textColor.black};
  font-size: ${fontSize.sm};
  font-weight: ${fontWeight.normal};
  white-space: pre-line;
  word-break: break-all;
  line-height: 1.5;
  a {
    color: ${textColor.red};
  }
  &.-red {
    color: ${textColor.red};
  }
  &.-blue {
    color: ${textColor.blue};
  }
  &.-white {
    color: ${textColor.white};
  }
  &.-left {
    text-align: left;
  }
  &.-end {
    text-align: end;
  }
  &.-center {
    text-align: center;
  }
  &.-inline {
    display: inline-block;
  }
  &.-underline {
    text-decoration: underline;
  }
  &.-bold {
    font-weight: ${fontWeight.bold};
  }
  &.-nowrap {
    white-space: nowrap;
  }
  &.-full {
    width: 100%;
  }
  &.-medium {
    font-size: ${fontSize.md};
  }
  &.-large {
    font-size: ${fontSize.lg};
  }
  &.-xxl {
    font-size: ${fontSize.xxl};
  }
`
