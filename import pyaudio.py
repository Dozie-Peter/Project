import pyaudio

p = pyaudio.PyAudio()
print("PyAudio version:", p.get_version())
p.terminate()
