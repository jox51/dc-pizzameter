import os
import sys
import json
import livepopulartimes
from dotenv import load_dotenv

def main(place_id):
    # Load environment variables from .env file
    load_dotenv()

    # Get API key from environment variable
    api_key = os.getenv("GOOGLE_MAPS_API_KEY")
    if not api_key:
        raise ValueError("GOOGLE_MAPS_API_KEY not found in environment variables")

    # Call the function with the required parameters
    result = livepopulartimes.get_populartimes_by_PlaceID(api_key, place_id)

    # Convert the result to JSON and print it
    print(json.dumps(result))

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python main.py <place_id>")
        sys.exit(1)
    
    place_id = sys.argv[1]
    main(place_id)