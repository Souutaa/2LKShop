let _paginationNumbers = document.getElementById("pagination-numbers");
let _paginatedList = document.getElementById("render-cart");
let _listItems = _paginatedList.querySelectorAll(".cart");
let _nextButton = document.getElementById("next-button");
let _prevButton = document.getElementById("prev-button");

let _paginationLimit = 4;
let _pageCount = Math.ceil(_listItems.length / _paginationLimit);
let currentPage = 1;

const disableButton = (button) => {
  button.classList.add("disabled");
  button.setAttribute("disabled", true);
};

const enableButton = (button) => {
  button.classList.remove("disabled");
  button.removeAttribute("disabled");
};

const handlePageButtonsStatus = () => {
  if (currentPage === 1) {
    disableButton(_prevButton);
  } else {
    enableButton(_prevButton);
  }

  if (_pageCount === currentPage) {
    disableButton(_nextButton);
  } else {
    enableButton(_nextButton);
  }
};

const handleActivePageNumber = () => {
  document.querySelectorAll(".pagination-number").forEach((button) => {
    button.classList.remove("active");
    const pageIndex = Number(button.getAttribute("page-index"));
    if (pageIndex == currentPage) {
      button.classList.add("active");
    }
  });
};

const appendPageNumber = (index) => {
  const pageNumber = document.createElement("button");
  pageNumber.className = "pagination-number";
  pageNumber.innerHTML = index;
  pageNumber.setAttribute("page-index", index);
  pageNumber.setAttribute("aria-label", "Page " + index);

  _paginationNumbers.appendChild(pageNumber);
};

const get_PaginationNumbers = (_pageCount) => {
  for (let i = 1; i <= _pageCount; i++) {
    appendPageNumber(i);
  }
};

const setCurrentPage = (pageNum) => {
  currentPage = pageNum;

  handleActivePageNumber();
  handlePageButtonsStatus();

  const prevRange = (pageNum - 1) * _paginationLimit;
  const currRange = pageNum * _paginationLimit;

  _listItems.forEach((item, index) => {
    item.classList.add("hidden");
    if (index >= prevRange && index < currRange) {
      item.classList.remove("hidden");
      if (_listItems.length - index <= 3) {
        _paginatedList.classList.add("grid-4-col");
        _paginatedList.classList.remove("grid-4-col-auto");
      } else {
        _paginatedList.classList.remove("grid-4-col");
        _paginatedList.classList.add("grid-4-col-auto");
      }
    }
  });
};

window.addEventListener("load", () => {
  get_PaginationNumbers(_pageCount);
  setCurrentPage(1);

  _prevButton.addEventListener("click", () => {
    setCurrentPage(currentPage - 1);
  });

  _nextButton.addEventListener("click", () => {
    setCurrentPage(currentPage + 1);
  });

  document.querySelectorAll(".pagination-number").forEach((button) => {
    const pageIndex = Number(button.getAttribute("page-index"));

    if (pageIndex) {
      button.addEventListener("click", () => {
        setCurrentPage(pageIndex);
      });
    }
  });
});
