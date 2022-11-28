const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Air Force",
    price: 20000,
    desc : "The legend lives on in the Nike Air Force 1 '07 Craft—a modern take on the iconic AF-1 with new details like fresh graphics on the tongue and heel. Crisp leather, brushed suede and exposed stitching on the upper add texture and depth while the new plush liner feels soft and comfortable. Its redesigned shape returns to OG roots, adding heritage style.",
    colors: [
      {
        code: "black",
        img: "./img/air.png",
      },
      {
        code: "darkblue",
        img: "./img/air2.png",
      },
    ],
  },
  {
    id: 2,
    title: "Air Jordan",
    price: 18000,
    desc : "You've got the hops and the speed—lace up in shoes that enhance what you bring to the court. The latest AJ is all about take-offs and landings, with multiple Air units to get you off the ground and Formula 23 foam to cushion your impact. Up top, you'll find layers of tough, reinforced leno-weave fabric that'll keep you contained—and leave your game uncompromised—no matter how fast you move.",
    colors: [
      {
        code: "lightgray",
        img: "./img/jordan.png",
      },
      {
        code: "green",
        img: "./img/jordan2.png",
      },
    ],
  },
  {
    id: 3,
    title: "Blazer",
    price: 17500,
    desc : "Praised for its classic simplicity and comfort, the Nike Blazer Low Platform elevates the hoops icon. The lifted midsole/outsole lets you step confidently while the upper keeps the proportions you loved from the original.",
    colors: [
      {
        code: "lightgray",
        img: "./img/blazer.png",
      },
      {
        code: "green",
        img: "./img/blazer2.png",
      },
    ],
  },
  {
    id: 4,
    title: "Crater",
    price: 18000,
    desc : "Nike Crater Impact is part of our sustainability journey to transform trash into shoes that tread a little lighter.Made from at least 25% recycled material by weight, it brings in unique design choices that reduce waste when compared with traditional methods—like an embroidered Swoosh, efficient overlays and of course its Crater foam midsole.",
    colors: [
      {
        code: "black",
        img: "./img/crater.png",
      },
      {
        code: "lightgray",
        img: "./img/crater2.png",
      },
    ],
  },
  {
    id: 5,
    title: "Hippie",
    price: 18500,
    desc : "Space Hippie is an exploratory footwear collection inspired by life on Mars—where materials are scarce and there is no resupply mission. Created from scraps, or 'space junk', Space Hippie is the result of sustainable practices meeting radical design.",
    colors: [
      {
        code: "gray",
        img: "./img/hippie.png",
      },
      {
        code: "black",
        img: "./img/hippie2.png",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");
const currentProductDesc = document.querySelector('.productDesc')

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    //change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    //change the choosen product
    choosenProduct = products[index];
    //change texts of currentProduct
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "₹" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;
    currentProductDesc.innerText = choosenProduct.desc;
   document.getElementById('mytitle').setAttribute('value',choosenProduct.title);
   document.getElementById('myprice').setAttribute('value',choosenProduct.price);
    //assing new colors
    currentProductColors.forEach((color, index) => {
      color.style.backgroundColor = choosenProduct.colors[index].code;
      document.getElementById('mycolor').setAttribute('value',choosenProduct.colors[index].code);
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    currentProductImg.src = choosenProduct.colors[index].img;
    document.getElementById('mycolor').setAttribute('value',choosenProduct.colors[index].code);
  });
});

currentProductSizes.forEach((size, index) => {
  size.addEventListener("click", () => {
    document.getElementById('mysize').setAttribute('value',size.innerText);
    currentProductSizes.forEach((size) => {
      size.style.backgroundColor = "white";
      size.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});

const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});
