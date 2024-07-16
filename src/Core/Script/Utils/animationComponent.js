const toolbarAnimation = () => {
  const el = document.querySelector("#toolbar");

  anime({
    targets: el,
    keyframes: [
      { opacity: 0, translateY: -1000 },
      { opacity: 1, translateY: 0 },
    ],
    duration: 500,
    easing: "easeInOutQuad",
  });
};

const animationEntranceTodoListStyle = () => {
  anime({
    targets: ".list-action .item-action",
    keyframes: [
      { translateX: -40, opacity: 0 },
      { translateX: 0, opacity: 1 },
    ],
    delay: anime.stagger(100, { start: 300 }),
  });
};

const animationTodoAction = () => {
  const tl = anime.timeline({ easing: "easeInOutQuad", duartion: 500 });

  tl.add({
    targets: "#list-todo-action #toggle-five-todo",
    keyframes: [
      { translateY: -40, opacity: 0 },
      { translateY: 0, opacity: 1 },
    ],
  })
    .add({
      targets: " #list-todo-action #toggle-all-todo",
      keyframes: [
        { translateY: 40, opacity: 0 },
        { translateY: 0, opacity: 1 },
      ],
    })
    .add({
      targets: " #list-todo-action #toggle-pending-todo",
      keyframes: [
        { translateY: -40, opacity: 0 },
        { translateY: 0, opacity: 1 },
      ],
    })
    .add({
      targets: " #list-todo-action #toggle-done-todo",
      keyframes: [
        { translateY: 40, opacity: 0 },
        { translateY: 0, opacity: 1 },
      ],
    });
};

animationTodoAction();

animationEntranceTodoListStyle();
toolbarAnimation();
