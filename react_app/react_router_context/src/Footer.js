
const Footer = () => {
  const today = new Date()

  return (
    <footer className="Footer">
      <h2>Footer {today.getFullYear()}</h2>
    </footer>
  )
}

export default Footer
