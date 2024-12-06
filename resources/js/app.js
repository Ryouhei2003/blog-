import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const campfire = document.querySelector(".campfire");
    const colors = ["bg-orange-500", "bg-red-500", "bg-yellow-400"];
    let index = 0;

    setInterval(() => {
        campfire.classList.remove(...colors);
        campfire.classList.add(colors[index]);
        index = (index + 1) % colors.length;
    }, 500); // 500msごとに色を切り替える
});
document.addEventListener("DOMContentLoaded", () => {
    const starsContainer = document.getElementById("stars");

    function createStar() {
        const star = document.createElement("div");
        star.classList.add("absolute", "w-2", "h-2", "bg-yellow-400", "rounded-full", "animate-star-fall");

        // ランダムな位置に生成
        star.style.left = `${Math.random() * 100}vw`;
        star.style.top = `-10vh`;
        star.style.animationDuration = `${Math.random() * 3 + 2}s`;

        starsContainer.appendChild(star);

        // アニメーション終了後に削除
        star.addEventListener("animationend", () => star.remove());
    }

    setInterval(createStar, 300); // 300msごとに星を生成
    

});
