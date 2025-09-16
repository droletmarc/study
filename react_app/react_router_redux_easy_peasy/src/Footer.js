import { useStoreState } from 'easy-peasy'

const Footer = () => {
  const postCount = useStoreState((state) => state.postCount)
  const today = new Date()

  return (
    <footer className="Footer">
      <h2>Footer {today.getFullYear()}</h2>
      <p>{postCount} Blog Posts</p>
    </footer>
  )
}

export default Footer
