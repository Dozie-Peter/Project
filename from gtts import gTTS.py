from gtts import gTTS
import os

def text_to_speech(text, language='en', filename='output.mp3'):
    # Create a gTTS object
    tts = gTTS(text=text, lang=language, slow=False)

    # Save the audio file
    tts.save(filename)

    # Play the audio file (requires a media player)
    os.system(f'start {filename}')

if __name__ == "__main__":
    # Example usage
    text_to_speech("How are you Emeka. I hope you are good")
