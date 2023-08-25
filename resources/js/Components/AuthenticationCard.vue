<template>
    <div class="p-4 xl:p-0 min-h-screen flex flex-col  items-center pt-6 sm:pt-0 bg-gradient-to-tr from-slate-800 to-slate-900 pb-20">
        
        <div class="pt-4">
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-7xl  mt-6 px-6 py-4 bg-white  overflow-hidden ">
            <slot />
        </div>
    </div>
</template>
