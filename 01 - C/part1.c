// https://adventofcode.com/2023/day/1

// Consider your entire calibration document. 
// What is the sum of all of the calibration values?


#include <iostream>
#include <fstream>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int toInt(char c) {
    switch (c) {
        case '0':
            return 0;
            break;
        case '1':
            return 1;
            break;
        case '2':
            return 2;
            break;
        case '3':
            return 3;
            break;
        case '4':
            return 4;
            break;
        case '5':
            return 5;
            break;
        case '6':
            return 6;
            break;
        case '7':
            return 7;
            break;
        case '8':
            return 8;
            break;
        case '9':
            return 9;
            break;
        default:
            return -1;
            break;
    }
}

int main() {
    char input[100];
    int num;
    int sum = 0;

    FILE* fptr = fopen("input.txt", "r");
    if (!fptr) {
        printf("File not Found");
        return 1;
    }
    int n = 0;

    
    int pos = 0;
    char number[2];
    int line = 0;
    while (fgets(input, 100, fptr)) {
        line++;
        while (input[n+1] != '\0') {
            num = toInt(input[n]);
            printf("%c", input[n]);
            
            // not a digit
            if (num == -1) {
                n++;
                continue;
            }
            
            if (pos == 0) {
                number[0] = input[n];
                pos++;
            }
            if (pos == 1) {
                number[1] = input[n];
            }
            n++;
        }
        printf("\n");
        number[2] = NULL;
        printf("%i:%i\n",line,atoi(number));
        sum += atoi(number);
        pos = 0;

        printf("\n\0");
        n = 0;
    }
    printf("answer is: %i\n", sum);
    system("pause");

    return 0;
}