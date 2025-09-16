import { useState, useEffect } from 'react'

const useWindowSize = () => {
  const [ windowSize, setWindowSize] = useState({
    width: undefined,
    height: undefined
  })

  useEffect(() => {
    const handleResize = () => {
      setWindowSize({
        width: window.innerWidth,
        height: window.innerHeight
      })
    }

    handleResize()
    window.addEventListener('resize', handleResize)

    // needed because the EventListner needed to be cleaned
    // the useEffect cleaner run only on a valule into the []
    // const cleanUp = () => {
    //   console.log('runs if a useEffect dependency changes')
    //   window.removeEventListener('resize', handleResize)
    // }

    // return cleanUp

    // this way replace the CleanUp function
    return () => { window.removeEventListener('resize', handleResize) }
  }, [])

  return windowSize
}

export default useWindowSize
