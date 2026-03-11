import os
import re

directories_to_scan = [
    ".",
]

exclude_dirs = [
    "vendor",
    "node_modules",
    "storage",
    "laravel-crm",
    ".git",
    "public/build",
    "public/installer",
]

exclude_files = [
    "replace_krayin.py",
    "find_krayin.php",
    "krayin_files.txt",
    "krayin_files_utf8.txt",
    "krayin_references.txt"
]

extensions_to_scan = [".php", ".json", ".md", ".js", ".css", ".vue", ".txt", ".csv", ".example"]

def scan_and_replace(directory):
    files_modified = 0
    for root, dirs, files in os.walk(directory):
        # Mutating dirs in-place to skip excluded directories
        dirs[:] = [d for d in dirs if d not in exclude_dirs]
        
        for file in files:
            if file in exclude_files:
                continue
                
            file_path = os.path.join(root, file)
            
            # Check extension
            if not any(file.endswith(ext) for ext in extensions_to_scan):
                continue
                
            try:
                with open(file_path, 'r', encoding='utf-8') as f:
                    content = f.read()
            except UnicodeDecodeError:
                continue # Skip binary files

            if 'krayin' in content.lower():
                # Perform replacements
                new_content = re.sub(r'\bKrayin\b', 'Sharmindar', content)
                new_content = re.sub(r'\bkrayin\b', 'sharmindar', new_content)
                new_content = re.sub(r'\bKRAYIN\b', 'SHARMINDAR', new_content)
                
                # Replace Krayin specifically in composer package names
                new_content = new_content.replace('krayin/laravel-', 'sharmindar/laravel-')
                
                if new_content != content:
                    with open(file_path, 'w', encoding='utf-8') as f:
                        f.write(new_content)
                    files_modified += 1
                    print(f"Updated: {file_path}")

    print(f"Total files modified: {files_modified}")

if __name__ == "__main__":
    scan_and_replace(".")
    
    # Also rename the file
    old_file = os.path.join("config", "krayin-vite.php")
    new_file = os.path.join("config", "sharmindar-vite.php")
    if os.path.exists(old_file):
        os.rename(old_file, new_file)
        print(f"Renamed {old_file} to {new_file}")
    
