import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.store('theme', {
  current: (localStorage.getItem('theme') || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')),
  set(theme) {
    this.current = theme
    if (theme === 'dark') {
      document.documentElement.classList.add('dark')
      document.documentElement.classList.remove('light')
      localStorage.setItem('theme', 'dark')
    } else {
      document.documentElement.classList.remove('dark')
      document.documentElement.classList.add('light')
      localStorage.setItem('theme', 'light')
    }
    window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme } }))
  },
  toggle() {
    this.set(this.current === 'dark' ? 'light' : 'dark')
  },
  resetToSystem() {
    localStorage.removeItem('theme')
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
    this.set(prefersDark ? 'dark' : 'light')
  }
})

Alpine.start()
