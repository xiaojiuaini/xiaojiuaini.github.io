import os
import json
import time
from datetime import datetime

def compress_json_files(directory):
    """压缩指定目录及其子目录中的所有JSON文件"""
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.endswith('.json'):
                file_path = os.path.join(root, file)
                with open(file_path, 'r', encoding='utf-8') as f:
                    data = json.load(f)
                
                # 压缩JSON数据
                compressed_data = json.dumps(data, separators=(',', ':'), ensure_ascii=False)
                
                # 写入压缩后的数据
                with open(file_path, 'w', encoding='utf-8') as f:
                    f.write(compressed_data)
                
                print(f"Compressed {file_path}")

def update_timestamps(directory, timestamp):
    """更新目录及其子目录和文件的时间戳"""
    for root, dirs, files in os.walk(directory):
        os.utime(root, (timestamp, timestamp))  # 更新目录时间戳
        for file in files:
            file_path = os.path.join(root, file)
            os.utime(file_path, (timestamp, timestamp))  # 更新文件时间戳

def get_user_input_time():
    """获取用户输入的时间并转换为时间戳"""
    while True:
        try:
            user_time = input("请输入时间（格式：YYYY-MM-DD HH:MM:SS）: ")
            timestamp = time.mktime(datetime.strptime(user_time, "%Y-%m-%d %H:%M:%S").timetuple())
            return timestamp
        except ValueError:
            print("输入的时间格式不正确，请重新输入！")

def main():
    while True:
        # 输入目录
        directory = input("请输入目录路径: ")
        if not os.path.isdir(directory):
            print("输入的路径不是一个目录，请重新输入！")
            continue
        
        # 压缩JSON文件
        compress_json_files(directory)
        
        # 获取用户输入的时间并转换为时间戳
        timestamp = get_user_input_time()
        
        # 更新时间戳
        update_timestamps(directory, timestamp)
        
        # 询问是否处理另一个目录
        choice = input("是否要处理另一个目录？(y/n): ")
        if choice.lower() == 'y':
            continue
        elif choice.lower() == 'n':
            print("已退出。")
            break
        else:
            print("输入有误，请输入'y'或'n'。")

if __name__ == "__main__":
    main()
