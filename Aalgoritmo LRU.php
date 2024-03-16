<?php
class LRUCache:
def __init__(self, capacity):
self.capacity = capacity
self.cache = {}
self.keys = []

def get(self, key):
if key in self.cache:
self.keys.remove(key)
self.keys.append(key)
return self.cache[key]
else:
return None

def put(self, key, value):
if key in self.cache:
self.keys.remove(key)
elif len(self.cache) >= self.capacity:
oldest_key = self.keys.pop(0)
del self.cache[oldest_key]
self.cache[key] = value
self.keys.append(key)

# Función para interactuar con la caché
def interact_with_cache(cache):
while True:
print("\nOpciones:")
print("1. Agregar elemento a la caché")
print("2. Consultar valor en la caché")
print("3. Salir")
choice = input("Seleccione una opción: ")

if choice == "1":
key = input("Ingrese la clave: ")
value = input("Ingrese el valor: ")
cache.put(key, value)
print("Elemento agregado a la caché.")
elif choice == "2":
key = input("Ingrese la clave a consultar: ")
value = cache.get(key)
if value is not None:
print("El valor asociado con la clave", key, "es:", value)
else:
print("La clave", key, "no está en la caché.")
elif choice == "3":
print("Saliendo del programa.")
break
else:
print("Opción no válida. Por favor, seleccione nuevamente.")

# Ejemplo de uso
cache = LRUCache(3)  # Creamos una caché con capacidad para 3 elementos
interact_with_cache(cache)  # Interactuar con la caché