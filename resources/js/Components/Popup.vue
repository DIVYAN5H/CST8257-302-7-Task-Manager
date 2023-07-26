<script>
</script>

<template>
    <div class="popup">
        <div class="popup-inner bg-blue">
          <slot />
          
        </div>
    </div>
</template>



<style>
.popup{position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 99;
	background-color: rgba(0, 0, 0, 0.2);
	
	display: flex;
	align-items: center;
	justify-content: center;
}
.popup-box{
  text-align: center;
  height: 24rem;
  width: 24rem;
  backdrop-filter: blur(8px);
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 5px;
  color: white;
  padding: 10px;
}
</style>