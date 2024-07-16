export const itemTodoStyle = (el) => {
  console.info("itemTodoStyle", el);
  el.classList.add(
    "flex",
    "flex-col",
    "-tranlate-x-100",
    "p-4",
    "w-full",
    "border",
    "rounded-lg",
    "todo-item",
    "opacity-0",
  );
};

export const fieldTodoStyle = (el) => {
  el.classList.add("flex", "flex-col", "p-4", "w-full");
};

export const headerTodoStyle = (el) => {
  el.classList.add(
    "flex",
    "flex-col",
    "gap-4",
    "md:flex-row",
    "justify-between",
    "items-center",
    "md:p-4",
    "w-full",
  );
};

export const labelStateTodoStyle = (el) => {
  el.classList.add("inline-flex", "items-center", "me-5", "cursor-pointer");
};

export const inputStateTodo = (el) => {
  el.classList.add("sr-only", "peer");
};

export const blockToggleSlideStyle = (el) => {
  el.classList.add(
    "relative",
    "w-11",
    "h-6",
    "bg-gray-200",
    "rounded-full",
    "peer",
    "dark:bg-gray-700",
    "peer-focus:ring-4",
    "peer-focus:ring-green-300",
    "dark:peer-focus:ring-green-800",
    "peer-checked:after:translate-x-full",
    "rtl:peer-checked:after:-translate-x-full",
    "peer-checked:after:border-white",
    "after:content-['']",
    "after:absolute",
    "after:top-0.5",
    "after:start-[2px]",
    "after:bg-white",
    "after:border-gray-300",
    "after:border",
    "after:rounded-full",
    "after:h-5",
    "after:w-5",
    "after:transition-all",
    "dark:border-gray-600",
    "peer-checked:bg-green-600",
  );
};

export const infoTodoStyle = (el) => {
  el.classList.add(
    "text-base",
    "font-normal",
    "w-full",
    "md:p-4",
    "block",
    "hidden",
    "opacity-0",
    "scale-y-0",
  );
};

export const showInfoButtonStyle = (el) => {
  el.classList.add(
    "text-sm",
    "font-semibold",
    "rounded-md",
    "bg-blue-500",
    "text-white",
    "p-2",
    "hover:bg-blue-700",
  );
};

export const infoIconStyle = () => {
  return `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
</svg>
`;
};

export const optionsTodoStyle = (el) => {
  el.classList.add(
    "flex",
    "inline-flex",
    "justify-start",
    "items-center",
    "p-4",
    "w-full",
    "gap-4",
    "hidden",
    "opacity-0",
  );
};

export const btnRemoveOptionsStyle = (el) => {
  el.classList.add(
    "text-sm",
    "font-semibold",
    "rounded-md",
    "bg-red-500",
    "text-white",
    "p-2",
    "hover:bg-red-700",
  );
};

export const btnEditOptionsStyle = (el) => {
  el.classList.add(
    "text-sm",
    "font-semibold",
    "rounded-md",
    "bg-yellow-700",
    "text-white",
    "p-2",
    "hover:bg-yellow-500",
  );
};

export const optionsIcon = () => {
  return `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
</svg>
`;
};

export const animationEntranceTodoListStyle = () => {
  anime({
    targets: "#list-todo .todo-item",
    keyframes: [
      { translateX: -100, opacity: 0 },
      { translateX: 0, opacity: 1 },
    ],
    delay: anime.stagger(50, { start: 150 }),
  });
};

export const animationNewTodoStyle = (el) => {
  anime({
    targets: el,
    keyframes: [
      { translateX: -100, opacity: 0 },
      { translateX: 0, opacity: 1 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
  });
};

export const animationOpenTodoStyle = (el) => {
  anime({
    targets: el,
    keyframes: [
      { translateY: -20, opacity: 0 },
      { translateY: 0, opacity: 1 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
  });
};

export const animationCloseTodoStyle = (el) => {
  anime({
    targets: el,
    keyframes: [
      { translateY: 0, opacity: 1 },
      { translateY: -20, opacity: 0 },
    ],
    duration: 200,
    easing: "easeInOutQuad",
    complete: () => {
      el.classList.toggle("hidden");
    },
  });
};
