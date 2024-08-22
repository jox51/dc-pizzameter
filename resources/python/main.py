import populartimes

import sys

import populartimes.populartimes

def main():
    # Check if API key is provided as command-line argument
    # if len(sys.argv) < 2:
    #     print("Usage: python main.py <API_KEY>")
    #     sys.exit(1)
    
    # api_key = sys.argv[1]
    api_key = "AIzaSyAkLsCYK08nH0utBVejWBBNb6jFnzlj3gY"
    place_id = "ChIJSYuuSx9awokRyrrOFTGg0GY"
    
    result = populartimes.populartimes.get_id(api_key, place_id)
    print(result)

if __name__ == "__main__":
    main()

