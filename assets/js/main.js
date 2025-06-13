// Global variables
let currentFilter = ""
let displayedDestinations = 6
let displayedReviews = 6

// Dummy data (replace with actual data loading)
const categoryNames = {
  nature: "Wisata Alam",
  culture: "Wisata Budaya",
  adventure: "Petualangan",
  culinary: "Kuliner",
  relaxation: "Relaksasi",
}

const destinations = [
  {
    id: 1,
    name: "Pantai Kuta",
    category: "nature",
    image:
      "https://images.unsplash.com/photo-1502005229762-cf1b43c059f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8a3V0YSUyMGJlYWNofGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
    rating: 4.5,
    reviews: 120,
    description: "Pantai terkenal dengan ombak yang bagus untuk selancar.",
    price: "Gratis",
    isRecommended: true,
    location: "Kuta, Bali",
    facilities: ["Toilet", "Area Parkir", "Penyewaan Selancar"],
    openHours: "Buka 24 jam",
    bestTime: "Pagi dan Sore",
  },
  {
    id: 2,
    name: "Tanah Lot",
    category: "culture",
    image:
      "https://images.unsplash.com/photo-1600149044752-9df495599ff9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8dGFuYWglMjBsb3R8ZW58MHx8MHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    rating: 4.7,
    reviews: 150,
    description: "Pura yang terletak di atas batu karang di tepi pantai.",
    price: "Rp 20.000",
    isRecommended: true,
    location: "Tabanan, Bali",
    facilities: ["Toilet", "Area Parkir", "Restoran"],
    openHours: "07:00 - 19:00",
    bestTime: "Sore hari",
  },
  {
    id: 3,
    name: "Gunung Batur",
    category: "adventure",
    image:
      "https://images.unsplash.com/photo-1614904494453-6633833a96c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8R3VudW5nJTIwQmF0dXJ8ZW58MHx8MHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    rating: 4.6,
    reviews: 130,
    description: "Gunung berapi aktif yang populer untuk pendakian.",
    price: "Rp 50.000",
    isRecommended: false,
    location: "Kintamani, Bali",
    facilities: ["Toilet", "Area Parkir", "Pemandu Wisata"],
    openHours: "Buka 24 jam",
    bestTime: "Pagi hari",
  },
  {
    id: 4,
    name: "Ubud",
    category: "culture",
    image:
      "https://images.unsplash.com/photo-1563982541634-066d57299a8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8VWJ1ZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    rating: 4.8,
    reviews: 160,
    description: "Pusat seni dan budaya Bali dengan sawah yang indah.",
    price: "Gratis",
    isRecommended: true,
    location: "Ubud, Bali",
    facilities: ["Toilet", "Area Parkir", "Galeri Seni"],
    openHours: "Buka 24 jam",
    bestTime: "Kapan saja",
  },
  {
    id: 5,
    name: "Seminyak",
    category: "relaxation",
    image:
      "https://images.unsplash.com/photo-1614951545992-9968613085ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8U2VtaW55YWt8ZW58MHx8MHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    rating: 4.4,
    reviews: 110,
    description: "Pantai dengan bar dan restoran mewah.",
    price: "Gratis",
    isRecommended: false,
    location: "Seminyak, Bali",
    facilities: ["Toilet", "Area Parkir", "Bar"],
    openHours: "Buka 24 jam",
    bestTime: "Sore hari",
  },
  {
    id: 6,
    name: "Nusa Penida",
    category: "nature",
    image:
      "https://images.unsplash.com/photo-1590077847417-24a94714998c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8TnVzYSUyMFBlbmlkYXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
    rating: 4.9,
    reviews: 180,
    description: "Pulau dengan pemandangan tebing dan pantai yang spektakuler.",
    price: "Rp 30.000",
    isRecommended: true,
    location: "Nusa Penida, Bali",
    facilities: ["Toilet", "Area Parkir", "Penyewaan Motor"],
    openHours: "Buka 24 jam",
    bestTime: "Pagi hari",
  },
  {
    id: 7,
    name: "Pura Ulun Danu Beratan",
    category: "culture",
    image:
      "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/Pura_Ulun_Danu_Beratan.jpg/1280px-Pura_Ulun_Danu_Beratan.jpg",
    rating: 4.7,
    reviews: 140,
    description: "Pura indah di tepi Danau Beratan dengan arsitektur khas Bali.",
    price: "Rp 25.000",
    isRecommended: false,
    location: "Bedugul, Bali",
    facilities: ["Toilet", "Area Parkir", "Restoran"],
    openHours: "08:00 - 18:00",
    bestTime: "Pagi hari",
  },
  {
    id: 8,
    name: "Air Terjun Sekumpul",
    category: "adventure",
    image: "https://exploreindonesia.id/wp-content/uploads/2023/02/Air-Terjun-Sekumpul-1.jpg",
    rating: 4.6,
    reviews: 125,
    description: "Air terjun tersembunyi yang menantang untuk dijelajahi.",
    price: "Rp 15.000",
    isRecommended: false,
    location: "Singaraja, Bali",
    facilities: ["Toilet", "Area Parkir", "Pemandu Wisata"],
    openHours: "08:00 - 17:00",
    bestTime: "Pagi hari",
  },
  {
    id: 9,
    name: "Jimbaran",
    category: "culinary",
    image:
      "https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Jimbaran_Bay_Indonesia.jpg/1280px-Jimbaran_Bay_Indonesia.jpg",
    rating: 4.5,
    reviews: 115,
    description: "Pantai yang terkenal dengan restoran seafood yang lezat.",
    price: "Variatif",
    isRecommended: false,
    location: "Jimbaran, Bali",
    facilities: ["Toilet", "Area Parkir", "Restoran"],
    openHours: "17:00 - 23:00",
    bestTime: "Malam hari",
  },
]

const reviews = [
  {
    id: 1,
    destinationId: 1,
    userName: "John Doe",
    userAvatar: "https://randomuser.me/api/portraits/men/1.jpg",
    date: "2023-08-01",
    rating: 5,
    comment: "Pantai yang indah, sangat cocok untuk bersantai!",
    helpful: 15,
    images: [],
  },
  {
    id: 2,
    destinationId: 1,
    userName: "Jane Smith",
    userAvatar: "https://randomuser.me/api/portraits/women/2.jpg",
    date: "2023-07-25",
    rating: 4,
    comment: "Ombaknya bagus untuk surfing, tapi terlalu ramai.",
    helpful: 8,
    images: [],
  },
  {
    id: 3,
    destinationId: 2,
    userName: "Mike Brown",
    userAvatar: "https://randomuser.me/api/portraits/men/3.jpg",
    date: "2023-07-20",
    rating: 5,
    comment: "Pemandangan yang luar biasa, sangat direkomendasikan!",
    helpful: 20,
    images: [],
  },
  {
    id: 4,
    destinationId: 2,
    userName: "Lisa Green",
    userAvatar: "https://randomuser.me/api/portraits/women/4.jpg",
    date: "2023-07-15",
    rating: 4,
    comment: "Tempat yang bagus untuk menikmati sunset.",
    helpful: 12,
    images: [],
  },
  {
    id: 5,
    destinationId: 3,
    userName: "David White",
    userAvatar: "https://randomuser.me/api/portraits/men/5.jpg",
    date: "2023-07-10",
    rating: 3,
    comment: "Pendakian yang menantang, tapi pemandangannya sepadan.",
    helpful: 5,
    images: [],
  },
  {
    id: 6,
    destinationId: 3,
    userName: "Emily Black",
    userAvatar: "https://randomuser.me/api/portraits/women/6.jpg",
    date: "2023-07-05",
    rating: 4,
    comment: "Pemandangan matahari terbit yang sangat indah.",
    helpful: 10,
    images: [],
  },
  {
    id: 7,
    destinationId: 1,
    userName: "Kevin Hart",
    userAvatar: "https://randomuser.me/api/portraits/men/7.jpg",
    date: "2023-06-28",
    rating: 5,
    comment: "Salah satu pantai terbaik yang pernah saya kunjungi!",
    helpful: 18,
    images: [],
  },
  {
    id: 8,
    destinationId: 4,
    userName: "Scarlett Johansson",
    userAvatar: "https://randomuser.me/api/portraits/women/8.jpg",
    date: "2023-06-22",
    rating: 5,
    comment: "Ubud adalah tempat yang sangat menenangkan dan indah.",
    helpful: 22,
    images: [],
  },
  {
    id: 9,
    destinationId: 5,
    userName: "Chris Hemsworth",
    userAvatar: "https://randomuser.me/api/portraits/men/9.jpg",
    date: "2023-06-15",
    rating: 4,
    comment: "Seminyak memiliki banyak bar dan restoran yang bagus.",
    helpful: 14,
    images: [],
  },
  {
    id: 10,
    destinationId: 6,
    userName: "Natalie Portman",
    userAvatar: "https://randomuser.me/api/portraits/women/10.jpg",
    date: "2023-06-08",
    rating: 5,
    comment: "Nusa Penida memiliki pemandangan yang luar biasa!",
    helpful: 25,
    images: [],
  },
]

// Utility Functions
// Perbaikan fungsi loadComponent untuk memastikan header dan footer dimuat dengan benar
function loadComponent(elementId, filePath) {
  const element = document.getElementById(elementId)
  if (!element) {
    console.error(`Element with id ${elementId} not found`)
    return
  }

  fetch(filePath)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Failed to load ${filePath}: ${response.status} ${response.statusText}`)
      }
      return response.text()
    })
    .then((data) => {
      element.innerHTML = data
      // Set active nav link based on current page
      if (elementId === "header-placeholder") {
        setActiveNavLink()
      }
    })
    .catch((error) => {
      console.error(`Error loading component ${filePath}:`, error)
      element.innerHTML = `<div class="alert alert-danger">Failed to load component. Please refresh the page.</div>`
    })
}

function setActiveNavLink() {
  const currentPage = window.location.pathname.split("/").pop() || "index.html"
  const navLinks = document.querySelectorAll(".nav-link")

  navLinks.forEach((link) => {
    link.classList.remove("active")
    const href = link.getAttribute("href")
    if (href === currentPage || (currentPage === "" && href === "index.html")) {
      link.classList.add("active")
    }
  })
}

function generateStars(rating) {
  const fullStars = Math.floor(rating)
  const hasHalfStar = rating % 1 !== 0
  let stars = ""

  for (let i = 0; i < fullStars; i++) {
    stars += '<i class="bi bi-star-fill"></i>'
  }

  if (hasHalfStar) {
    stars += '<i class="bi bi-star-half"></i>'
  }

  const emptyStars = 5 - Math.ceil(rating)
  for (let i = 0; i < emptyStars; i++) {
    stars += '<i class="bi bi-star"></i>'
  }

  return stars
}

function getCategoryName(category) {
  return categoryNames[category] || category
}

function createDestinationCard(dest, isAI = false) {
  return `
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card destination-card h-100">
                <div class="position-relative">
                    ${dest.isRecommended ? `<div class="recommendation-badge">${isAI ? "🤖 AI Recommend" : "⭐ Popular"}</div>` : ""}
                    <img src="${dest.image}" class="card-img-top" alt="${dest.name}" style="height: 250px; object-fit: cover;">
                    <div class="price-tag">${dest.price}</div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0 fw-semibold">${dest.name}</h5>
                        <span class="category-badge">${getCategoryName(dest.category)}</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="rating-stars me-2">
                            ${generateStars(dest.rating)}
                        </div>
                        <span class="text-muted small fw-medium">${dest.rating} (${dest.reviews} review)</span>
                    </div>
                    <p class="card-text text-muted mb-3">${dest.description}</p>
                    <div class="d-flex gap-2">
                        <a href="destination-detail.html?id=${dest.id}" class="btn btn-primary btn-sm flex-fill fw-medium">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                        <button class="btn btn-outline-primary btn-sm" onclick="addToWishlist(${dest.id})" title="Tambah ke Wishlist">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `
}

function createReviewCard(review) {
  return `
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="review-card h-100">
                <div class="d-flex align-items-center mb-3">
                    <img src="${review.userAvatar}" class="rounded-circle me-3" width="50" height="50" alt="${review.userName}">
                    <div>
                        <h6 class="mb-0 fw-semibold">${review.userName}</h6>
                        <small class="text-muted">${review.date}</small>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-primary mb-0 fw-semibold">${review.destination}</h6>
                    <div class="rating-stars">
                        ${generateStars(review.rating)}
                    </div>
                </div>
                <p class="text-muted mb-3">"${review.comment}"</p>
                ${
                  review.images.length > 0
                    ? `
                    <div class="mb-3">
                        ${review.images.map((img) => `<img src="${img}" class="rounded me-2 mb-2" width="80" height="60" style="object-fit: cover;">`).join("")}
                    </div>
                `
                    : ""
                }
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-sm btn-outline-primary fw-medium" onclick="likeReview(${review.id})">
                        <i class="bi bi-hand-thumbs-up me-1"></i> Helpful (${review.helpful})
                    </button>
                    <button class="btn btn-sm btn-outline-secondary fw-medium" onclick="replyReview(${review.id})">
                        <i class="bi bi-reply me-1"></i> Reply
                    </button>
                </div>
            </div>
        </div>
    `
}

// Home Page Functions
function loadFeaturedDestinations() {
  const container = document.getElementById("featuredDestinations")
  if (!container) return

  const featured = destinations.filter((dest) => dest.isRecommended).slice(0, 3)
  container.innerHTML = featured.map((dest) => createDestinationCard(dest)).join("")
}

function setupSearchForm() {
  const searchForm = document.getElementById("searchForm")
  if (!searchForm) return

  searchForm.addEventListener("submit", (e) => {
    e.preventDefault()
    const searchTerm = document.getElementById("searchDestination").value
    const category = document.getElementById("categoryFilter").value
    const rating = document.getElementById("ratingFilter").value

    // Redirect to destinations page with search parameters
    let url = "destinations.html?"
    if (searchTerm) url += `search=${encodeURIComponent(searchTerm)}&`
    if (category) url += `category=${category}&`
    if (rating) url += `rating=${rating}&`

    window.location.href = url
  })
}

// Destinations Page Functions
function initDestinationsPage() {
  loadAllDestinations()
  setupDestinationFilters()
  setupLoadMore()

  // Parse URL parameters
  const urlParams = new URLSearchParams(window.location.search)
  const searchTerm = urlParams.get("search")
  const category = urlParams.get("category")
  const rating = urlParams.get("rating")

  if (searchTerm) document.getElementById("searchInput").value = searchTerm
  if (category) {
    document.getElementById("categorySelect").value = category
    currentFilter = category
    updateFilterButtons()
  }
  if (rating) document.getElementById("ratingSelect").value = rating

  if (searchTerm || category || rating) {
    loadAllDestinations()
  }
}

function setupDestinationFilters() {
  // Search and filter form
  const searchForm = document.getElementById("searchFilterForm")
  if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault()
      displayedDestinations = 6
      loadAllDestinations()
    })
  }

  // Filter buttons
  document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
      document.querySelectorAll(".filter-btn").forEach((b) => b.classList.remove("active"))
      this.classList.add("active")
      currentFilter = this.dataset.category
      displayedDestinations = 6
      loadAllDestinations()
    })
  })

  // Sort dropdown
  const sortSelect = document.getElementById("sortSelect")
  if (sortSelect) {
    sortSelect.addEventListener("change", () => {
      loadAllDestinations()
    })
  }
}

function updateFilterButtons() {
  document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.classList.remove("active")
    if (btn.dataset.category === currentFilter) {
      btn.classList.add("active")
    }
  })
}

// Advanced filter functions
function toggleAdvancedFilter() {
  const advancedFilters = document.getElementById("advancedFilters")
  if (advancedFilters.style.display === "none") {
    advancedFilters.style.display = "block"
  } else {
    advancedFilters.style.display = "none"
  }
}

function applyAdvancedFilters() {
  loadAllDestinations()
  document.getElementById("advancedFilters").style.display = "none"
}

function resetAllFilters() {
  // Reset basic filters
  document.getElementById("searchInput").value = ""
  document.getElementById("categorySelect").value = ""
  document.getElementById("ratingSelect").value = ""
  document.getElementById("budgetSelect").value = ""

  // Reset advanced filters
  document.getElementById("travelTypeFilter").value = ""
  document.getElementById("monthFilter").value = ""
  document.getElementById("durationFilter").value = ""

  // Reset radio buttons
  document.querySelectorAll('input[name="activityFilter"]').forEach((radio) => {
    radio.checked = false
  })

  // Reset checkboxes
  document.querySelectorAll('#advancedFilters input[type="checkbox"]').forEach((checkbox) => {
    checkbox.checked = false
  })

  // Reset filter buttons
  document.querySelectorAll(".filter-btn").forEach((btn) => btn.classList.remove("active"))
  document.querySelector('.filter-btn[data-category=""]').classList.add("active")

  currentFilter = ""
  displayedDestinations = 6
  loadAllDestinations()
}

// Enhanced loadAllDestinations function with advanced filters
function loadAllDestinations() {
  const container = document.getElementById("destinationsGrid")
  if (!container) return

  let filteredDestinations = [...destinations]

  // Apply basic filters
  const searchTerm = document.getElementById("searchInput")?.value.toLowerCase() || ""
  const category = document.getElementById("categorySelect")?.value || currentFilter
  const rating = document.getElementById("ratingSelect")?.value || ""
  const budget = document.getElementById("budgetSelect")?.value || ""
  const sortBy = document.getElementById("sortSelect")?.value || "popular"

  // Apply advanced filters
  const travelType = document.getElementById("travelTypeFilter")?.value || ""
  const month = document.getElementById("monthFilter")?.value || ""
  const duration = document.getElementById("durationFilter")?.value || ""
  const activityLevel = document.querySelector('input[name="activityFilter"]:checked')?.value || ""

  // Get selected facilities
  const selectedFacilities = []
  document.querySelectorAll('#advancedFilters input[type="checkbox"]:checked').forEach((checkbox) => {
    selectedFacilities.push(checkbox.value)
  })

  // Apply filters
  if (searchTerm) {
    filteredDestinations = filteredDestinations.filter(
      (dest) => dest.name.toLowerCase().includes(searchTerm) || dest.description.toLowerCase().includes(searchTerm),
    )
  }

  if (category) {
    filteredDestinations = filteredDestinations.filter((dest) => dest.category === category)
  }

  if (rating) {
    filteredDestinations = filteredDestinations.filter((dest) => dest.rating >= Number.parseFloat(rating))
  }

  if (budget) {
    filteredDestinations = filteredDestinations.filter((dest) => dest.priceRange === budget)
  }

  if (travelType) {
    filteredDestinations = filteredDestinations.filter(
      (dest) => dest.travelType && dest.travelType.includes(travelType),
    )
  }

  if (month) {
    filteredDestinations = filteredDestinations.filter(
      (dest) => dest.bestMonths && dest.bestMonths.includes(Number.parseInt(month)),
    )
  }

  if (duration) {
    filteredDestinations = filteredDestinations.filter((dest) => dest.duration === duration)
  }

  if (activityLevel) {
    filteredDestinations = filteredDestinations.filter((dest) => dest.activityLevel === activityLevel)
  }

  if (selectedFacilities.length > 0) {
    filteredDestinations = filteredDestinations.filter((dest) => {
      return selectedFacilities.every((facility) => {
        const facilityMap = {
          parking: ["Parkir", "Area Parkir"],
          toilet: ["Toilet"],
          restaurant: ["Restoran", "Warung", "Cafe"],
          wifi: ["WiFi", "Wifi"],
          guide: ["Guide", "Pemandu", "Pemandu Wisata"],
          transport: ["Transportasi"],
          ac: ["AC"],
          photo: ["Spot Foto"],
        }

        const facilityNames = facilityMap[facility] || [facility]
        return facilityNames.some((name) => dest.facilities.some((f) => f.toLowerCase().includes(name.toLowerCase())))
      })
    })
  }

  // Apply sorting
  switch (sortBy) {
    case "rating":
      filteredDestinations.sort((a, b) => b.rating - a.rating)
      break
    case "name":
      filteredDestinations.sort((a, b) => a.name.localeCompare(b.name))
      break
    case "price":
      filteredDestinations.sort((a, b) => {
        const priceA = a.price === "Gratis" ? 0 : Number.parseInt(a.price.replace(/\D/g, ""))
        const priceB = b.price === "Gratis" ? 0 : Number.parseInt(b.price.replace(/\D/g, ""))
        return priceA - priceB
      })
      break
    default: // popular
      filteredDestinations.sort((a, b) => b.reviews - a.reviews)
  }

  // Update results info
  const resultCount = document.getElementById("resultCount")
  if (resultCount) {
    resultCount.textContent = filteredDestinations.length
  }

  // Display destinations
  const destinationsToShow = filteredDestinations.slice(0, displayedDestinations)
  container.innerHTML = destinationsToShow.map((dest) => createDestinationCard(dest)).join("")

  // Update load more button
  const loadMoreBtn = document.getElementById("loadMoreBtn")
  if (loadMoreBtn) {
    if (displayedDestinations >= filteredDestinations.length) {
      loadMoreBtn.style.display = "none"
    } else {
      loadMoreBtn.style.display = "block"
    }
  }
}

function setupLoadMore() {
  const loadMoreBtn = document.getElementById("loadMoreBtn")
  if (!loadMoreBtn) return

  loadMoreBtn.addEventListener("click", function () {
    const loading = this.querySelector(".loading")

    this.disabled = true
    loading.classList.remove("d-none")

    setTimeout(() => {
      displayedDestinations += 6
      loadAllDestinations()
      this.disabled = false
      loading.classList.add("d-none")
    }, 1000)
  })
}

// Reviews Page Functions
function initReviewsPage() {
  loadAllReviews()
  setupReviewFilters()
  populateDestinationFilter()
}

function populateDestinationFilter() {
  const select = document.getElementById("reviewDestinationFilter")
  if (!select) return

  destinations.forEach((dest) => {
    const option = document.createElement("option")
    option.value = dest.id
    option.textContent = dest.name
    select.appendChild(option)
  })
}

function setupReviewFilters() {
  const filters = ["reviewDestinationFilter", "reviewRatingFilter", "reviewSortFilter"]
  filters.forEach((filterId) => {
    const filter = document.getElementById(filterId)
    if (filter) {
      filter.addEventListener("change", () => {
        loadAllReviews()
      })
    }
  })

  const loadMoreBtn = document.getElementById("loadMoreReviews")
  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", () => {
      displayedReviews += 6
      loadAllReviews()
    })
  }
}

function loadAllReviews() {
  const container = document.getElementById("reviewsGrid")
  if (!container) return

  let filteredReviews = [...reviews]

  // Apply filters
  const destinationFilter = document.getElementById("reviewDestinationFilter")?.value || ""
  const ratingFilter = document.getElementById("reviewRatingFilter")?.value || ""
  const sortFilter = document.getElementById("reviewSortFilter")?.value || "newest"

  if (destinationFilter) {
    filteredReviews = filteredReviews.filter((review) => review.destinationId == destinationFilter)
  }

  if (ratingFilter) {
    filteredReviews = filteredReviews.filter((review) => review.rating == ratingFilter)
  }

  // Apply sorting
  switch (sortFilter) {
    case "oldest":
      filteredReviews.reverse()
      break
    case "helpful":
      filteredReviews.sort((a, b) => b.helpful - a.helpful)
      break
    default: // newest
    // Already in newest order
  }

  const reviewsToShow = filteredReviews.slice(0, displayedReviews)
  container.innerHTML = reviewsToShow.map((review) => createReviewCard(review)).join("")

  // Update load more button
  const loadMoreBtn = document.getElementById("loadMoreReviews")
  if (loadMoreBtn) {
    if (displayedReviews >= filteredReviews.length) {
      loadMoreBtn.style.display = "none"
    } else {
      loadMoreBtn.style.display = "block"
    }
  }
}

// Enhanced recommendations functions
function setupPreferenceForm() {
  const form = document.getElementById("preferenceForm")
  if (!form) return

  form.addEventListener("submit", (e) => {
    e.preventDefault()

    // Get form data
    const formData = new FormData(form)
    const preferences = {
      travelType: formData.get("travelType"),
      visitMonth: document.getElementById("visitMonth").value,
      categories: [],
      budget: document.getElementById("budgetRange").value,
      duration: document.getElementById("tripDuration").value,
      activityLevel: formData.get("activityLevel"),
      facilities: [],
    }

    // Get selected categories
    document.querySelectorAll('#preferenceForm input[type="checkbox"]:checked').forEach((checkbox) => {
      if (checkbox.id.startsWith("pref-")) {
        preferences.categories.push(checkbox.value)
      } else if (checkbox.id.startsWith("facility-")) {
        preferences.facilities.push(checkbox.value)
      }
    })

    // Save preferences to localStorage
    localStorage.setItem("userPreferences", JSON.stringify(preferences))

    // Update recommendations
    loadAIRecommendations()

    // Show success message
    showPreferenceUpdateMessage()
  })
}

function resetPreferences() {
  // Reset form
  document.getElementById("preferenceForm").reset()

  // Clear localStorage
  localStorage.removeItem("userPreferences")

  // Reload default recommendations
  loadAIRecommendations()

  alert("Preferensi telah direset ke pengaturan default.")
}

const travelTypeNames = {
  solo: "Perjalanan Sendiri",
  couple: "Pasangan",
  family: "Keluarga",
  friends: "Teman",
}

const monthNames = {
  1: "Januari",
  2: "Februari",
  3: "Maret",
  4: "April",
  5: "Mei",
  6: "Juni",
  7: "Juli",
  8: "Agustus",
  9: "September",
  10: "Oktober",
  11: "November",
  12: "Desember",
}

const activityLevelNames = {
  relax: "Santai",
  moderate: "Sedang",
  active: "Aktif",
}

function loadAIRecommendations() {
  const container = document.getElementById("aiRecommendations")
  if (!container) return

  // Get user preferences
  const preferences = JSON.parse(localStorage.getItem("userPreferences") || "{}")

  let recommended = [...destinations]

  // Apply preference-based filtering
  if (preferences.travelType) {
    recommended = recommended.filter((dest) => dest.travelType && dest.travelType.includes(preferences.travelType))
  }

  if (preferences.visitMonth) {
    recommended = recommended.filter(
      (dest) => dest.bestMonths && dest.bestMonths.includes(Number.parseInt(preferences.visitMonth)),
    )
  }

  if (preferences.categories && preferences.categories.length > 0) {
    recommended = recommended.filter((dest) => preferences.categories.includes(dest.category))
  }

  if (preferences.budget) {
    recommended = recommended.filter((dest) => dest.priceRange === preferences.budget)
  }

  if (preferences.duration) {
    recommended = recommended.filter((dest) => dest.duration === preferences.duration)
  }

  if (preferences.activityLevel) {
    recommended = recommended.filter((dest) => dest.activityLevel === preferences.activityLevel)
  }

  // If no matches found, show popular destinations
  if (recommended.length === 0) {
    recommended = destinations.filter((dest) => dest.isRecommended)
  }

  // Sort by rating and limit to top 6
  recommended.sort((a, b) => b.rating - a.rating)
  recommended = recommended.slice(0, 6)

  const preferenceText = generatePreferenceText(preferences)

  container.innerHTML = `
    <div class="col-12 mb-5">
      <div class="alert alert-primary border-0 shadow-sm">
        <div class="d-flex align-items-center">
          <i class="bi bi-robot me-3 fs-4"></i>
          <div>
            <h6 class="alert-heading mb-1">Rekomendasi Personal untuk Anda</h6>
            <p class="mb-0">${preferenceText}</p>
          </div>
        </div>
      </div>
    </div>
    ${recommended.map((dest) => createDestinationCard(dest, true)).join("")}
  `
}

function generatePreferenceText(preferences) {
  let text = "Berdasarkan analisis preferensi Anda"

  if (preferences.travelType) {
    text += ` untuk ${travelTypeNames[preferences.travelType]}`
  }

  if (preferences.visitMonth) {
    text += ` di bulan ${monthNames[Number.parseInt(preferences.visitMonth)]}`
  }

  if (preferences.activityLevel) {
    text += ` dengan aktivitas ${activityLevelNames[preferences.activityLevel]}`
  }

  text += ", berikut adalah destinasi yang mungkin Anda sukai"

  return text
}

function showPreferenceUpdateMessage() {
  // Create and show a toast notification
  const toast = document.createElement("div")
  toast.className = "toast align-items-center text-white bg-success border-0 position-fixed"
  toast.style.cssText = "top: 100px; right: 20px; z-index: 9999;"
  toast.innerHTML = `
    <div class="d-flex">
      <div class="toast-body">
        <i class="bi bi-check-circle me-2"></i>
        Rekomendasi telah diperbarui berdasarkan preferensi Anda!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
    </div>
  `

  document.body.appendChild(toast)

  // Auto remove after 3 seconds
  setTimeout(() => {
    if (toast.parentElement) {
      toast.remove()
    }
  }, 3000)
}

// Load saved preferences on page load
function loadSavedPreferences() {
  const preferences = JSON.parse(localStorage.getItem("userPreferences") || "{}")

  if (Object.keys(preferences).length === 0) return

  // Set form values
  if (preferences.travelType) {
    const radio = document.getElementById(`travel-${preferences.travelType}`)
    if (radio) radio.checked = true
  }

  if (preferences.visitMonth) {
    const select = document.getElementById("visitMonth")
    if (select) select.value = preferences.visitMonth
  }

  if (preferences.budget) {
    const select = document.getElementById("budgetRange")
    if (select) select.value = preferences.budget
  }

  if (preferences.duration) {
    const select = document.getElementById("tripDuration")
    if (select) select.value = preferences.duration
  }

  if (preferences.activityLevel) {
    const radio = document.getElementById(`activity-${preferences.activityLevel}`)
    if (radio) radio.checked = true
  }

  // Set category checkboxes
  if (preferences.categories) {
    preferences.categories.forEach((category) => {
      const checkbox = document.getElementById(`pref-${category}`)
      if (checkbox) checkbox.checked = true
    })
  }

  // Set facility checkboxes
  if (preferences.facilities) {
    preferences.facilities.forEach((facility) => {
      const checkbox = document.getElementById(`facility-${facility}`)
      if (checkbox) checkbox.checked = true
    })
  }
}

// Update initRecommendationsPage function
function initRecommendationsPage() {
  setupPreferenceForm()
  loadSavedPreferences()
  loadAIRecommendations()
}

// Recommendations Page Functions
//function initRecommendationsPage() {
//  loadAIRecommendations()
//  setupPreferenceForm()
//}

//function setupPreferenceForm() {
//  const form = document.getElementById("preferenceForm")
//  if (!form) return

//  form.addEventListener("submit", (e) => {
//    e.preventDefault()
//    loadAIRecommendations()
//    alert("Rekomendasi telah diperbarui berdasarkan preferensi Anda!")
//  })
//}

//function loadAIRecommendations() {
//  const container = document.getElementById("aiRecommendations")
//  if (!container) return

//  const recommended = destinations.filter((dest) => dest.isRecommended)

//  container.innerHTML = `
//        <div class="col-12 mb-5">
//            <div class="alert alert-primary border-0 shadow-sm">
//                <div class="d-flex align-items-center">
//                    <i class="bi bi-robot me-3 fs-4"></i>
//                    <div>
//                        <h6 class="alert-heading mb-1">Rekomendasi Personal untuk Anda</h6>
//                        <p class="mb-0">Berdasarkan analisis preferensi dan riwayat pencarian Anda, berikut adalah destinasi yang mungkin Anda sukai</p>
//                    </div>
//                </div>
//            </div>
//        </div>
//        ${recommended.map((dest) => createDestinationCard(dest, true)).join("")}
//    `
//}

// Destination Detail Functions
function loadDestinationDetail(id) {
  const destination = destinations.find((dest) => dest.id === id)
  if (!destination) {
    window.location.href = "destinations.html"
    return
  }

  const destinationReviews = reviews.filter((review) => review.destinationId === id)
  const relatedDestinations = destinations
    .filter((d) => d.category === destination.category && d.id !== destination.id)
    .slice(0, 3)

  document.getElementById("destinationDetailContent").innerHTML = `
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4">
                    <button class="btn btn-outline-primary mb-3" onclick="history.back()">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <img src="${destination.image}" class="img-fluid rounded-3 w-100" style="height: 400px; object-fit: cover;" alt="${destination.name}">
                </div>
                
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h2 fw-bold mb-2">${destination.name}</h1>
                            <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> ${destination.location}</p>
                            <div class="d-flex align-items-center">
                                <div class="rating-stars me-2">${generateStars(destination.rating)}</div>
                                <span class="fw-medium">${destination.rating} (${destination.reviews} review)</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="h4 fw-bold text-primary mb-2">${destination.price}</div>
                            <span class="category-badge">${getCategoryName(destination.category)}</span>
                        </div>
                    </div>
                    
                    <p class="text-muted mb-4">${destination.description}</p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-3">Fasilitas:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                ${destination.facilities
                                  .map(
                                    (facility) => `
                                    <span class="badge bg-light text-dark border px-3 py-2">${facility}</span>
                                `,
                                  )
                                  .join("")}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-3">Informasi:</h6>
                            <p class="mb-1"><strong>Jam Buka:</strong> ${destination.openHours}</p>
                            <p class="mb-0"><strong>Waktu Terbaik:</strong> ${destination.bestTime}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button class="btn btn-primary flex-fill" onclick="bookDestination(${destination.id})">
                            <i class="bi bi-calendar-check me-2"></i>Book Sekarang
                        </button>
                        <button class="btn btn-outline-primary" onclick="addToWishlist(${destination.id})">
                            <i class="bi bi-heart me-2"></i>Wishlist
                        </button>
                        <button class="btn btn-outline-secondary" onclick="shareDestination(${destination.id})">
                            <i class="bi bi-share me-2"></i>Share
                        </button>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="bg-white p-4 rounded-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0">Review (${destinationReviews.length})</h5>
                        <button class="btn btn-primary btn-sm" onclick="writeReview(${destination.id})">
                            <i class="bi bi-plus me-1"></i>Tulis Review
                        </button>
                    </div>
                    
                    ${
                      destinationReviews.length > 0
                        ? `
                        <div class="row">
                            ${destinationReviews
                              .map(
                                (review) => `
                                <div class="col-12 mb-4">
                                    ${createReviewCard(review)}
                                </div>
                            `,
                              )
                              .join("")}
                        </div>
                    `
                        : `
                        <div class="text-center py-5">
                            <i class="bi bi-chat-dots text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">Belum ada review untuk destinasi ini</p>
                            <button class="btn btn-primary" onclick="writeReview(${destination.id})">
                                Jadilah yang pertama menulis review
                            </button>
                        </div>
                    `
                    }
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm sticky-top" style="top: 100px;">
                    <h6 class="fw-semibold mb-3">Destinasi Serupa</h6>
                    ${relatedDestinations
                      .map(
                        (dest) => `
                        <div class="d-flex mb-3 cursor-pointer" onclick="window.location.href='destination-detail.html?id=${dest.id}'">
                            <img src="${dest.image}" class="rounded me-3" width="80" height="60" style="object-fit: cover;" alt="${dest.name}">
                            <div>
                                <h6 class="mb-1 fw-semibold">${dest.name}</h6>
                                <div class="rating-stars small mb-1">${generateStars(dest.rating)}</div>
                                <small class="text-primary fw-semibold">${dest.price}</small>
                            </div>
                        </div>
                    `,
                      )
                      .join("")}
                </div>
            </div>
        </div>
    `
}

// Login Page Functions
function initLoginPage() {
  const loginForm = document.getElementById("loginForm")
  if (!loginForm) return

  loginForm.addEventListener("submit", (e) => {
    e.preventDefault()
    alert("Login berhasil! Selamat datang di Bali Explorer.")
    window.location.href = "index.html"
  })
}

// Register Page Functions
function initRegisterPage() {
  const registerForm = document.getElementById("registerForm")
  if (!registerForm) return

  registerForm.addEventListener("submit", (e) => {
    e.preventDefault()
    alert("Registrasi berhasil! Silakan login untuk melanjutkan.")
    window.location.href = "login.html"
  })
}

// Interactive Functions
function addToWishlist(id) {
  const destination = destinations.find((dest) => dest.id === id)
  alert(`${destination.name} berhasil ditambahkan ke wishlist!`)
}

function bookDestination(id) {
  const destination = destinations.find((dest) => dest.id === id)
  alert(`Booking untuk ${destination.name} akan segera tersedia. Terima kasih atas minat Anda!`)
}

function shareDestination(id) {
  const destination = destinations.find((dest) => dest.id === id)
  if (navigator.share) {
    navigator.share({
      title: destination.name,
      text: destination.description,
      url: window.location.href,
    })
  } else {
    alert(`Bagikan: ${destination.name}\n${destination.description}`)
  }
}

function writeReview(destinationId) {
  alert("Fitur tulis review akan segera tersedia. Terima kasih!")
}

function likeReview(reviewId) {
  alert("Review telah di-like!")
}

function replyReview(reviewId) {
  alert("Fitur reply review akan segera tersedia.")
}

function openReviewModal() {
  alert("Modal tulis review akan segera tersedia.")
}

// Navbar scroll effect
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar")
  if (navbar) {
    if (window.scrollY > 50) {
      navbar.style.boxShadow = "0 2px 20px rgba(0,0,0,0.1)"
    } else {
      navbar.style.boxShadow = "none"
    }
  }
})

// Initialize based on current page
document.addEventListener("DOMContentLoaded", () => {
  const currentPage = window.location.pathname.split("/").pop() || "index.html"

  // Set active navigation
  setTimeout(setActiveNavLink, 100)
})

// Pastikan semua halaman memuat header dan footer dengan benar
document.addEventListener("DOMContentLoaded", () => {
  // Load header and footer first
  const headerPlaceholder = document.getElementById("header-placeholder")
  const footerPlaceholder = document.getElementById("footer-placeholder")

  if (headerPlaceholder) {
    loadComponent("header-placeholder", "components/header.html")
  }

  if (footerPlaceholder) {
    loadComponent("footer-placeholder", "components/footer.html")
  }

  // Detect current page and initialize appropriate functions
  const currentPage = window.location.pathname.split("/").pop() || "index.html"

  // Initialize page-specific functions after a short delay to ensure header/footer are loaded
  setTimeout(() => {
    switch (currentPage) {
      case "index.html":
      case "":
        loadFeaturedDestinations()
        setupSearchForm()
        break
      case "destinations.html":
        initDestinationsPage()
        break
      case "reviews.html":
        initReviewsPage()
        break
      case "recommendations.html":
        initRecommendationsPage()
        break
      case "destination-detail.html":
        const urlParams = new URLSearchParams(window.location.search)
        const destinationId = urlParams.get("id")
        if (destinationId) {
          loadDestinationDetail(Number.parseInt(destinationId))
        }
        break
      case "login.html":
        initLoginPage()
        break
      case "register.html":
        initRegisterPage()
        break
    }

    // Set active navigation
    setActiveNavLink()
  }, 300)
})
