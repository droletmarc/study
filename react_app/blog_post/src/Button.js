import React from 'react'

const Button = ({ buttonText, reqType, setReqType}) => {
  return (
    <button
      type="button"
      className=""
      style={{
        backgroundColor: (reqType === buttonText ? 'black;' : 'white'),
        color: (reqType === buttonText ? 'white;' : 'black')
      }}
      onClick={() => setReqType(buttonText)}>
        {buttonText}
    </button>
  )
}

export default Button
