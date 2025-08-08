<div class="fixed z-40 bottom-20 left-1/2" style="transform: translateX(-50%)">
  <div
    x-data="{
      shown: false,
      message: '',
      timeout: null,
      show(msg) {
        this.message = msg;
        this.shown = true;
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
          this.shown = false;
        }, 3000);
      },
      hide() {
        this.shown = false;
        clearTimeout(this.timeout);
      }
    }"
    x-init="
      setTimeout(() => {
        Livewire.on('show-flash', ({ message }) => {
            show(message);
        });
      }, 0)
    "
    x-show="shown"
    @click="hide()"
    x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-10"
    x-cloak
    role="alert"
    id="flash-message"
    class="px-5 py-3 rounded-lg shadow-lg bg-gray-900 text-white border border-gray-800 max-w-max whitespace-nowrap cursor-pointer select-none"
    x-text="message"
  ></div>
</div>
